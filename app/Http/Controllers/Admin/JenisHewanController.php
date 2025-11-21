<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewans = JenisHewan::all();
        return view('admin.jenis-hewan.index', compact('jenisHewans'));
    }
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }
    public function edit($idjenis_hewan)
    {
        $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required'
        ]);

        // Buat user baru
        JenisHewan::create([
            'nama_jenis_hewan' => $validated['nama_jenis_hewan'],
        ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }
    public function update(Request $request, $idjenis_hewan)
    {
        // Temukan user yang akan diupdate
        $jenisHewans = JenisHewan::findOrFail($idjenis_hewan);

        // Validasi input
        $validated = $request->validate([
            'nama_jenis_hewan' => 'nullable|string|max:255',
        ]);

        // Update data user
        $jenisHewans->update([
            'nama_jenis_hewan' => $validated['nama_jenis_hewan'] ?? $jenisHewans->nama_role,
        ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis Hewan berhasil diperbarui.');
    }
    public function delete($idjenis_hewan)
    {
        $jenisHewans = JenisHewan::findOrFail($idjenis_hewan);
        $jenisHewans->delete();

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Role berhasil dihapus.');
    }
}
