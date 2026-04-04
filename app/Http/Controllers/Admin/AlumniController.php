<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AlumniTracking;
use App\Services\PddiktiService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumniExport;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    protected $pddiktiService;

    public function __construct(PddiktiService $pddiktiService)
    {
        $this->pddiktiService = $pddiktiService;
    }

    public function index(Request $request)
    {
        $query = Alumni::query();

        $searchNama = $request->search_nama;
        $searchEmail = $request->search_email;
        $searchTempatKerja = $request->search_tempat_kerja;
        $searchPosisi = $request->search_posisi;

        $query->when($searchNama, function ($q) use ($searchNama) {
            $q->where('nama', 'like', '%' . $searchNama . '%');
        })->when($searchEmail, function ($q) use ($searchEmail) {
            $q->where('email', 'like', '%' . $searchEmail . '%');
        })->when($searchTempatKerja, function ($q) use ($searchTempatKerja) {
            $q->where('perusahaan', 'like', '%' . $searchTempatKerja . '%');
        })->when($searchPosisi, function ($q) use ($searchPosisi) {
            $q->where('pekerjaan', 'like', '%' . $searchPosisi . '%');
        });

        $alumni = $query->paginate(10);

        $stats = [
            'total' => Alumni::count(),
            'pns' => Alumni::pns()->count(),
            'swasta' => Alumni::swasta()->count(),
            'wirausaha' => Alumni::wirausaha()->count(),
        ];

        return view('admin.alumni.index', compact('alumni', 'stats', 'searchNama', 'searchEmail', 'searchTempatKerja', 'searchPosisi'));

    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:alumni',
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:2100',
            'email' => 'required|email|unique:alumni',
            'no_hp' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'status_karir' => 'required|in:Bekerja,Wirausaha,Studi Lanjut,Belum Diketahui',
        ]);

        $alumni = Alumni::create($request->all());

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni added successfully.');
    }

    public function show(Alumni $alumni)
    {
        $alumni->load('trackings');
        return view('admin.alumni.show', compact('alumni'));
    }

    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $oldStatus = $alumni->status_karir;

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:alumni,nim,' . $alumni->id,
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:2100',
            'email' => 'required|email|unique:alumni,email,' . $alumni->id,
            'no_hp' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'status_karir' => 'required|in:Bekerja,Wirausaha,Studi Lanjut,Belum Diketahui',
        ]);

        if ($oldStatus != $request->status_karir) {
            AlumniTracking::create([
                'alumni_id' => $alumni->id,
                'status_karir_old' => $oldStatus,
                'status_karir_new' => $request->status_karir,
                'updated_by' => auth()->user()->name ?? 'Admin',
            ]);
        }

        $alumni->update($request->all());

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni updated successfully.');
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new AlumniExport, 'data_alumni.xlsx');
    }

    public function validatePddikti(Alumni $alumni)
    {
        $result = $this->pddiktiService->validateAlumni($alumni->nim);

        $alumni->update([
            'pddikti_status' => $result['status']
        ]);

        return redirect()->back()->with('success', $result['message']);
    }
}


