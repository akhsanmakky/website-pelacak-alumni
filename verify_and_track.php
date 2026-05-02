<?php
/**
 * Script untuk:
 * 1. Verifikasi PDDIKTI semua alumni data
 * 2. Tracking 10 alumni untuk test
 * 
 * Usage: php verify_and_track.php
 */

require __DIR__.'/vendor/autoload.php';

// Tambah memory limit dan kurangi query cache
ini_set('memory_limit', '2048M');
gc_disable();

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Alumni;
use App\Models\AlumniProfile;
use App\Services\PddiktiService;
use App\Services\ProfileGeneratorService;
use App\Services\QueryGeneratorService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

echo "=== PDDIKTI Verification & Tracking Test ===\n\n";

// Initialize services
$pddiktiService = new PddiktiService();
$profileGen = new ProfileGeneratorService();
$queryGen = new QueryGeneratorService();

// ===== STEP 1: PDDIKTI VERIFICATION =====

echo "STEP 1: Memulai Verifikasi PDDIKTI untuk batch pertama (100 alumni)...\n";

// Pakai DB query builder langsung untuk hemat memory
$pendingAlumni = DB::table('alumni')
    ->whereNull('pddikti_status')
    ->orWhere('pddikti_status', '!=', 'verified')
    ->limit(100)
    ->get();

$totalToVerify = count($pendingAlumni);
echo "Total alumni perlu verifikasi (batch 100): $totalToVerify\n";

if ($totalToVerify === 0) {
    echo "Semua alumni sudah diverifikasi!\n";
} else {
    $verified = 0;
    $notFound = 0;
    $errors = 0;
    
    echo "Mulai verifikasi...\n";
    
    $counter = 0;
    foreach ($pendingAlumni as $alumniData) {
        $counter++;
        
        try {
            // Progress indicator
            if ($counter % 10 === 0) {
                echo "Processed: $counter / $totalToVerify\n";
            }
            
            // Verify via PDDIKTI
            $result = $pddiktiService->validateAlumni($alumniData->nama, $alumniData->nim);
            
            // Update langsung via DB
            DB::table('alumni')
                ->where('id', $alumniData->id)
                ->update(['pddikti_status' => $result['status']]);
            
            if ($result['status'] === 'verified') {
                $verified++;
            } else {
                $notFound++;
            }
            
            // Small delay untuk avoid rate limiting
            usleep(100000); // 100ms
            
            // Manual GC every 10 iterations
            if ($counter % 10 === 0) {
                gc_collect_cycles();
            }
            
        } catch (\Exception $e) {
            Log::error("PDDIKTI error for {$alumniData->nama}: " . $e->getMessage());
            DB::table('alumni')
                ->where('id', $alumniData->id)
                ->update(['pddikti_status' => 'error']);
            $errors++;
        }
    }
    
    echo "\n=== Verification Results (Batch 1) ===\n";
    echo "Processed: $counter\n";
    echo "Verified: $verified\n";
    echo "Not Found: $notFound\n";
    echo "Errors: $errors\n";
    echo "\nCatatan: Jalankan ulang script untuk batch berikutnya.\n";
}

// ===== STEP 2: TRACKING 10 ALUMNI FOR TEST =====

echo "\n\nSTEP 2: Memulai Tracking untuk 10 alumni test...\n";

// Get alumni yang ready untuk tracking (sudah verified)
$alumniToTrack = DB::table('alumni')
    ->whereNull('pddikti_status') // Belum diverifikasi - tetap bisa di-track untuk test
    ->orWhere('pddikti_status', 'verified')
    ->limit(10)
    ->get();

echo "Ditemukan {$alumniToTrack->count()} alumni eligible untuk tracking.\n";

$tracked = 0;
foreach ($alumniToTrack as $alumniData) {
    echo "\nProcessing: {$alumniData->nama} ({$alumniData->nim})\n";
    
    try {
        // Get Alumni model
        $alumni = Alumni::find($alumniData->id);
        
        // Step 1: Create profile
        $profile = $profileGen->createProfile($alumni);
        echo "  - Profile created (ID: {$profile->id})\n";
        
        // Step 2: Generate queries
        $queries = $queryGen->generate($profile);
        echo "  - Generated " . count($queries) . " queries\n";
        
        // Step 3: Update status
        $profile->update(['status' => 'processing']);
        
        $tracked++;
        echo "  - SUCCESS\n";
        
    } catch (\Exception $e) {
        Log::error("Tracking error for {$alumniData->nama}: " . $e->getMessage());
        echo "  - ERROR: " . $e->getMessage() . "\n";
    }
    
    // Stop setelah 10
    if ($tracked >= 10) {
        break;
    }
}

echo "\n\n=== FINAL RESULTS ===\n";
echo "Alumni tracked untuk test: $tracked / 10\n";
echo "Selesai!\n";
