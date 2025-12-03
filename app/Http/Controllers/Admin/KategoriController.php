<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueNama ='unique:kategori,nama_kategori';
        $rules = [
            'nama_kategori' => "required|$uniqueNama",
        ];
        if ($mode === 'update') {
            $rules = [
                'nama_kategori' => "nullable|$uniqueNama",
            ];
        }
        return $request->validate($rules);
    }
    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }
    public function create()
    {
        return view('admin.kategori.create');
    }
    public function edit($idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        Kategori::create([
            'nama_kategori' => $this->FormatInput($validated['nama_kategori']),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function update(Request $request, $idkategori)
    {
        // Temukan user yang akan diupdate
        $kategori = Kategori::findOrFail($idkategori);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $kategori->update([
            'nama_kategori' => $this->FormatInput($validated['nama_kategori']) ?? $kategori->nama_kategori,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'KATEGORI berhasil diperbarui.');
    }
    public function delete($idkategori)
    {
        $kategori = Kategori::findOrFail($idkategori);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
