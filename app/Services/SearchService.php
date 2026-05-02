<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    private ?string $apiKey;
    private string $endpoint;
    private int $maxRetries = 3;
    private int $retryDelayMs = 1000;
    
    // Rate limiting settings
    private int $dailyLimit;
    private int $monthlyLimit;
    private const CACHE_DAILY_KEY = 'serper_daily_quota';
    private const CACHE_MONTHLY_KEY = 'serper_monthly_quota';
    private const CACHE_DAILY_RESET = 'serper_daily_reset_at';
    private const CACHE_MONTHLY_RESET = 'serper_monthly_reset_at';

    public function __construct()
    {
        $this->apiKey = config('services.serper.api_key');
        $this->endpoint = config('services.serper.endpoint', 'https://google.serper.dev/search');
        $this->dailyLimit = (int) config('services.serper.daily_limit', 100);
        $this->monthlyLimit = (int) config('services.serper.monthly_limit', 2000);
    }

    /**
     * Check if we have quota available
     */
    public function hasQuota(): bool
    {
        $dailyUsed = $this->getDailyUsage();
        $monthlyUsed = $this->getMonthlyUsage();
        
        return $dailyUsed < $this->dailyLimit && $monthlyUsed < $this->monthlyLimit;
    }

    /**
     * Get current quota status
     */
    public function getQuotaStatus(): array
    {
        return [
            'daily' => [
                'used' => $this->getDailyUsage(),
                'limit' => $this->dailyLimit,
                'remaining' => max(0, $this->dailyLimit - $this->getDailyUsage()),
                'reset_at' => Cache::get(self::CACHE_DAILY_RESET),
            ],
            'monthly' => [
                'used' => $this->getMonthlyUsage(),
                'limit' => $this->monthlyLimit,
                'remaining' => max(0, $this->monthlyLimit - $this->getMonthlyUsage()),
                'reset_at' => Cache::get(self::CACHE_MONTHLY_RESET),
            ],
        ];
    }

    /**
     * Perform search using SERPER API
     */
    public function search(string $query, string $source = 'google', int $num = 10): array
    {
        // If no API key configured, return mock results
        if (empty($this->apiKey)) {
            Log::warning('SERPER_API_KEY not configured. Using dev fallback results.');
            return $this->getDevFallbackResults($query);
        }

        // Check quota before making API call
        if (!$this->hasQuota()) {
            Log::warning('SERPER quota exceeded. Daily: ' . $this->getDailyUsage() . '/' . $this->dailyLimit);
            return $this->getDevFallbackResults($query, true);
        }

        // Map source to SERPER type
        $searchType = $this->mapSourceToSearchType($source);

        $results = $this->executeWithRetry($query, $searchType, $num);
        
        // Only increment quota on successful real API call
        if (!empty($results) && !isset($results[0]['source']) || $results[0]['source'] !== 'dev_fallback') {
            $this->incrementQuota();
        }

        return $results;
    }

    /**
     * Increment quota usage
     */
    private function incrementQuota(): void
    {
        $today = now()->startOfDay();
        $monthStart = now()->startOfMonth();
        
        // Daily counter
        Cache::remember(self::CACHE_DAILY_KEY, $today->addDay(), function () {
            return 0;
        });
        Cache::increment(self::CACHE_DAILY_KEY);
        
        // Set daily reset if not set
        if (!Cache::has(self::CACHE_DAILY_RESET)) {
            Cache::put(self::CACHE_DAILY_RESET, $today->toDateTimeString(), now()->addDay());
        }
        
        // Monthly counter
        Cache::remember(self::CACHE_MONTHLY_KEY, $monthStart->addMonth(), function () {
            return 0;
        });
        Cache::increment(self::CACHE_MONTHLY_KEY);
        
        // Set monthly reset if not set
        if (!Cache::has(self::CACHE_MONTHLY_RESET)) {
            Cache::put(self::CACHE_MONTHLY_RESET, $monthStart->toDateTimeString(), now()->addMonth());
        }
    }

    /**
     * Get daily usage
     */
    private function getDailyUsage(): int
    {
        return (int) Cache::get(self::CACHE_DAILY_KEY, 0);
    }

    /**
     * Get monthly usage
     */
    private function getMonthlyUsage(): int
    {
        return (int) Cache::get(self::CACHE_MONTHLY_KEY, 0);
    }

    /**
     * Reset quota (for testing)
     */
    public function resetQuota(): void
    {
        Cache::forget(self::CACHE_DAILY_KEY);
        Cache::forget(self::CACHE_MONTHLY_KEY);
        Cache::forget(self::CACHE_DAILY_RESET);
        Cache::forget(self::CACHE_MONTHLY_RESET);
        Log::info('SERPER quota reset manually');
    }

    /**
     * Map source string to SERPER search type
     */
    private function mapSourceToSearchType(string $source): string
    {
        return match($source) {
            'scholar' => 'scholar',
            'google', 'news', 'images', 'videos' => $source,
            default => 'search',
        };
    }

    /**
     * Execute search with retry logic
     */
    private function executeWithRetry(string $query, string $type, int $num): array
    {
        $lastException = null;

        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                $response = Http::withHeaders([
                    'X-API-KEY' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ])->timeout(30)->post($this->endpoint, [
                    'q' => $query,
                    'num' => $num,
                    'type' => $type,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    return match($type) {
                        'scholar' => $data['organic'] ?? $data['scholar'] ?? [],
                        'news' => $data['news'] ?? $data['organic'] ?? [],
                        default => $data['organic'] ?? [],
                    };
                }

                // Handle rate limiting
                $statusCode = $response->status();
                if ($statusCode === 429 || $statusCode >= 500) {
                    $lastException = new \Exception("SERPER API error: {$statusCode}");
                    $this->handleRateLimit($attempt);
                    continue;
                }

                Log::error('SERPER API error: ' . $response->body());
                break;

            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                $lastException = $e;
                Log::warning("SERPER API connection attempt {$attempt} failed: " . $e->getMessage());
                usleep($this->retryDelayMs * 1000);
            } catch (\Exception $e) {
                $lastException = $e;
                Log::error('SERPER API error: ' . $e->getMessage());
                break;
            }
        }

        Log::error('SERPER search failed after retries: ' . ($lastException?->getMessage() ?? 'Unknown error'));
        
        return $this->getDevFallbackResults($query, true);
    }

    /**
     * Handle rate limiting with exponential backoff
     */
    private function handleRateLimit(int $attempt): void
    {
        $delay = $this->retryDelayMs * pow(2, $attempt - 1);
        Log::info("Rate limited. Retrying after {$delay}ms...");
        usleep($delay * 1000);
    }

    /**
     * Fallback results
     */
    private function getDevFallbackResults(string $query, bool $quotaExceeded = false): array
    {
        $message = $quotaExceeded 
            ? "Quota exceeded. Set SERPER_DAILY_LIMIT in .env to adjust limit."
            : "Configuration required. Set SERPER_API_KEY in .env for real search results.";

        return [
            [
                'title' => "[DEV] {$query}",
                'link' => 'https://example.com/alumni/' . urlencode($query),
                'snippet' => $message,
                'position' => 1,
                'source' => 'dev_fallback',
            ],
        ];
    }

    /**
     * Check if API is configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get API status
     */
    public function getStatus(): array
    {
        return [
            'configured' => $this->isConfigured(),
            'endpoint' => $this->endpoint,
            'has_key' => !empty($this->apiKey) ? substr($this->apiKey, 0, 4) . '***' : null,
            'quota' => $this->getQuotaStatus(),
        ];
    }
}
