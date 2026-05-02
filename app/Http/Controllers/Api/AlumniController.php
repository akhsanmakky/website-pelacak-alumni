<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        return Alumni::with(['profile'])->paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:alumni',
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'email' => 'nullable|email|unique:alumni',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $alumni = Alumni::create($validated);

        return response()->json($alumni->load('profile'), 201);
    }

    public function show(Alumni $alumni)
    {
        $alumni->load(['profile.searchJobs.results', 'trackings']);
        return $alumni;
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:alumni,nim,' . $alumni->id,
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'email' => 'nullable|email|unique:alumni,email,' . $alumni->id,
            'no_hp' => 'nullable|string|max:20',
        ]);

        $alumni->update($validated);

        return $alumni->fresh(['profile']);
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();
        return response()->json(null, 204);
    }
}

