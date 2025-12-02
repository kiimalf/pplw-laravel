<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinisS = KategoriKlinis::all();
        return view('admin.kategori-klinis.index', compact('kategoriKlinisS'));
    }
    public function create()
    {
        return view('admin.kategori-klinis.create');
    }
    public function edit($idkategori_klinis)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required'
        ]);

        // Buat user baru
        KategoriKlinis::create([
            'nama_kategori_klinis' => $validated['nama_kategori_klinis'],
        ]);

        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }
    public function update(Request $request, $idkategori_klinis)
    {
        // Temukan user yang akan diupdate
        $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);

        // Validasi input
        $validated = $request->validate([
            'nama_kategori_klinis' => 'nullable|string|max:255',
        ]);

        // Update data user
        $kategoriKlinis->update([
            'nama_kategori_klinis' => $validated['nama_kategori_klinis'] ?? $kategoriKlinis->nama_kategori_klinis,
        ]);

        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori Klinis berhasil diperbarui.');
    }
    public function delete($idkategori_klinis)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($idkategori_klinis);
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')->with('success', 'Kategori Klinis berhasil dihapus.');
    }
}
