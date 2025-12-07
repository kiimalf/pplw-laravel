<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
    protected function validateData(Request $request, $type = 'store')
    {
        $uniqueNama = 'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => $type === 'store'
                ? "required|$uniqueNama"
                : "nullable|$uniqueNama",
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    // ========================
    // INDEX (Query Builder)
    // ========================
    public function index()
    {
        $kategoriKlinisS = DB::table('kategori_klinis')->get();

        return view('admin.kategori-klinis.index', compact('kategoriKlinisS'));
    }

    public function create()
    {
        return view('admin.kategori-klinis.create');
    }

    // ========================
    // EDIT (Query Builder)
    // ========================
    public function edit($idkategori_klinis)
    {
        $kategoriKlinis = DB::table('kategori_klinis')
            ->where('idkategori_klinis', $idkategori_klinis)
            ->first();

        if (!$kategoriKlinis) {
            abort(404);
        }

        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    // ========================
    // STORE (Query Builder)
    // ========================
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('kategori_klinis')->insert([
            'nama_kategori_klinis' => $this->FormatInput($validated['nama_kategori_klinis']),
        ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }

    // ========================
    // UPDATE (Query Builder)
    // ========================
    public function update(Request $request, $idkategori_klinis)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $idkategori_klinis)
            ->update([
                'nama_kategori_klinis' =>
                    !empty($validated['nama_kategori_klinis'])
                        ? $this->FormatInput($validated['nama_kategori_klinis'])
                        : DB::table('kategori_klinis')->where('idkategori_klinis', $idkategori_klinis)->value('nama_kategori_klinis')
            ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil diperbarui.');
    }

    // ========================
    // DELETE (Query Builder)
    // ========================
    public function delete($idkategori_klinis)
    {
        DB::table('kategori_klinis')
            ->where('idkategori_klinis', $idkategori_klinis)
            ->delete();

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil dihapus.');
    }
}
