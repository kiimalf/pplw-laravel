<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueNama = 'unique:kategori,nama_kategori';

        return $request->validate([
            'nama_kategori' => $mode === 'create'
                ? "required|$uniqueNama"
                : "nullable|$uniqueNama",
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    // =======================
    // INDEX (Query Builder)
    // =======================
    public function index()
    {
        $kategoris = DB::table('kategori')->get();

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    // =======================
    // EDIT (Query Builder)
    // =======================
    public function edit($idkategori)
    {
        $kategori = DB::table('kategori')
            ->where('idkategori', $idkategori)
            ->first();

        if (!$kategori) {
            abort(404);
        }

        return view('admin.kategori.edit', compact('kategori'));
    }

    // =======================
    // STORE (Query Builder)
    // =======================
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('kategori')->insert([
            'nama_kategori' => $this->FormatInput($validated['nama_kategori']),
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // =======================
    // UPDATE (Query Builder)
    // =======================
    public function update(Request $request, $idkategori)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('kategori')
            ->where('idkategori', $idkategori)
            ->update([
                'nama_kategori' =>
                    !empty($validated['nama_kategori'])
                        ? $this->FormatInput($validated['nama_kategori'])
                        : DB::table('kategori')->where('idkategori', $idkategori)->value('nama_kategori')
            ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // =======================
    // DELETE (Query Builder)
    // =======================
    public function delete($idkategori)
    {
        DB::table('kategori')
            ->where('idkategori', $idkategori)
            ->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
