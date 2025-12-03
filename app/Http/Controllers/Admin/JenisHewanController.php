<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    protected function validateData(Request $request, $mode = 'store')
    {
        $uniqueJenis = 'unique:jenis_hewan,nama_jenis_hewan';

        return $request->validate([
            'nama_jenis_hewan' => $mode === 'store' ? "required|$uniqueJenis" : 'nullable'
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

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
        $validated = $this->validateData($request);

        // Buat user baru
        JenisHewan::create([
            'nama_jenis_hewan' => $this->FormatInput($validated['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }
    public function update(Request $request, $idjenis_hewan)
    {
        // Temukan user yang akan diupdate
        $jenisHewans = JenisHewan::findOrFail($idjenis_hewan);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $jenisHewans->update([
            'nama_jenis_hewan' => $this->FormatInput($validated['nama_jenis_hewan']) ?? $jenisHewans->nama_role,
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
