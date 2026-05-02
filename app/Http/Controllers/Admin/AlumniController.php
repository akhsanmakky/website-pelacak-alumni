<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AlumniTracking;
use App\Services\PddiktiService;
use App\Services\ProfileGeneratorService;
use App\Services\QueryGeneratorService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumniExport;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    protected $pddiktiService;
    protected $profileGen;
    protected $queryGen;

    public function __construct(PddiktiService $pddiktiService, ProfileGeneratorService $profileGen, QueryGeneratorService $queryGen)
    {
        $this->pddiktiService = $pddiktiService;
        $this->profileGen = $profileGen;
        $this->queryGen = $queryGen;
    }

    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
    {
        $query = Alumni::with(['profile', 'trackings']);

        $query->when($request->search_nama, fn($q) =>
            $q->where('nama', 'like', '%' . $request->search_nama . '%')
        );

        $alumni = $query->paginate(10);

        $stats = [
            'total' => Alumni::count(),
            'bekerja' => Alumni::bekerja()->count(),
            'wirausaha' => Alumni::wirausaha()->count(),
            'studi_lanjut' => Alumni::studiLanjut()->count(),
            'belum_diketahui' => Alumni::belumDiketahui()->count(),
        ];

        return view('admin.alumni.index', compact('alumni', 'stats'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:alumni',
            'prodi' => 'required',
            'tahun_lulus' => 'required|integer',
            'email' => 'required|email|unique:alumni',
            'no_hp' => 'required',
            'status_karir' => 'required',
        ]);

        Alumni::create($validated);

        return redirect()->back()->with('success', 'Alumni ditambahkan');
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, Alumni $alumnus)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:alumni,nim,' . $alumnus->id,
            'email' => 'required|email|unique:alumni,email,' . $alumnus->id,
        ]);

        $alumnus->update($validated);

        return redirect()->back()->with('success', 'Updated');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy(Alumni $alumnus)
    {
        $alumnus->delete();
        return redirect()->back()->with('success', 'Deleted');
    }

    // =========================
    // BULK TRACK - DIRECT JOB DISPATCH [IMPROVED]
    // =========================
    public function bulkTrack(Request $request)
    {
        try {
            $validated = $request->validate([
                'alumni_ids' => 'required|array|min:1',
                'alumni_ids.*' => 'integer|exists:alumni,id',
            ]);

            $alumniIds = array_unique($validated['alumni_ids']);
            $processed = 0;
            $jobs = [];

            foreach ($alumniIds as $id) {
                $alumni = Alumni::autoReady()->find($id);
                if (!$alumni) continue;

                // Create profile
                $profile = $this->profileGen->createProfile($alumni);
                
                // Generate queries
                $queries = $this->queryGen->generate($profile);
                
                // Dispatch search jobs for sources
                foreach (['google', 'scholar'] as $source) {
                    $jobs[] = new \App\Jobs\PerformSearchJob($profile, $queries, $source);
                }
                
                $processed++;
            }

            if (empty($jobs)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No eligible alumni found (must be autoReady)'
                ], 400);
            }

            // Batch for progress tracking
            $batch = \Illuminate\Support\Facades\Bus::batch($jobs)
                ->then(function () use ($processed) {
                    \Log::info("BulkTrack batch completed for {$processed} alumni");
                })
                ->catch(function ($batch, $e) {
                    \Log::error('BulkTrack batch failed: ' . $e->getMessage());
                })
                ->dispatch();

            return response()->json([
                'success' => true,
                'message' => "Tracking initiated for {$processed} alumni. Batch ID: {$batch->id}",
                'batch_id' => $batch->id,
                'processed' => $processed
            ]);

        } catch (\Exception $e) {
            \Log::error('BulkTrack Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

public function show(Alumni $alumnus)
    {
        $alumnus->load(['profile', 'trackings']);
        return view('admin.alumni.show', compact('alumnus'));
    }

/**
     * Validate single alumni via PDDIKTI
     */
    public function validatePddikti(Request $request, Alumni $alumnus)
    {
        try {
            $result = $this->pddiktiService->validateAlumni($alumnus->nama, $alumnus->nim);
            
            $alumnus->update(['pddikti_status' => $result['status']]);
            
            if ($result['status'] === 'verified') {
                return redirect()->back()->with('success', "Alumni \"{$alumnus->nama}\" terverifikasi di PDDIKTI!");
            } else {
                return redirect()->back()->with('warning', $result['message'] ?? 'Alumni tidak ditemukan di PDDIKTI.');
            }
        } catch (\Exception $e) {
            \Log::error('PDDIKTI validation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

public function bulkPddiktiVerify()
    {
        try {
            $pendingAlumni = Alumni::where(function ($q) {
                $q->whereNull('pddikti_status')
                  ->orWhere('pddikti_status', '!=', 'verified');
            })->get();

            if ($pendingAlumni->isEmpty()) {
                return redirect()->back()->with('info', 'Semua alumni sudah diverifikasi atau tidak ada alumni yang perlu diverifikasi.');
            }

            $verified = 0;
            $errors = 0;
            $total = $pendingAlumni->count();

            foreach ($pendingAlumni as $alumni) {
                try {
                    $result = $this->pddiktiService->validateAlumni($alumni->nama, $alumni->nim);
                    $alumni->update(['pddikti_status' => $result['status']]);
                    
                    if ($result['status'] === 'verified') {
                        $verified++;
                    } else {
                        $errors++;
                    }
                } catch (\Exception $e) {
                    \Log::error("PDDIKTI verification error for alumni ID {$alumni->id}: " . $e->getMessage());
                    $alumni->update(['pddikti_status' => 'error']);
                    $errors++;
                }
            }

            return redirect()->back()->with('success', "Verifikasi PDDIKTI selesai: {$verified} terverifikasi, {$errors} error dari total {$total} alumni");

        } catch (\Exception $e) {
            \Log::error('bulkPddiktiVerify error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
