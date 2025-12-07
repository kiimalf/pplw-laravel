<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodeTindakanTerapiController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueKode = 'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode' => $mode === 'create' ? "required|$uniqueKode" : "nullable|$uniqueKode",
            'idkategori' => $mode === 'create' ? "required" : "nullable",
            'idkategori_klinis' => $mode === 'create' ? "required" : "nullable",
            'deskripsi_tindakan_terapi' => $mode === 'create' ? "required" : "nullable",
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    // ======================================================
    // INDEX – dengan JOIN agar langsung tampil kategori & klinis
    // ======================================================
    public function index()
    {
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi as t')
            ->join('kategori as k', 't.idkategori', '=', 'k.idkategori')
            ->join('kategori_klinis as kk', 't.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->select(
                't.*',
                'k.nama_kategori',
                'kk.nama_kategori_klinis'
            )
            ->get();

        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    // ======================================================
    // CREATE
    // ======================================================
    public function create()
    {
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->get();

        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    // ======================================================
    // EDIT – load kategori & klinis lain untuk dropdown
    // ======================================================
    public function edit($idkode_tindakan_terapi)
    {
        // Ambil data utama dengan join supaya blade bisa akses kategori & kategoriKlinis
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kategori.idkategori', '=', 'kode_tindakan_terapi.idkategori')
            ->join('kategori_klinis', 'kategori_klinis.idkategori_klinis', '=', 'kode_tindakan_terapi.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)
            ->first();

        if (!$kodeTindakanTerapi) abort(404);

        // Daftar kategori lain untuk dropdown
        $kategori = DB::table('kategori')
            ->where('idkategori', '!=', $kodeTindakanTerapi->idkategori)
            ->get();

    // Daftar kategori klinis lain untuk dropdown
    $kategoriKlinis = DB::table('kategori_klinis')
        ->where('idkategori_klinis', '!=', $kodeTindakanTerapi->idkategori_klinis)
        ->get();

    return view('admin.kode-tindakan-terapi.edit', compact(
        'kodeTindakanTerapi',
        'kategori',
        'kategoriKlinis'
    ));
}


    // ======================================================
    // STORE
    // ======================================================
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('kode_tindakan_terapi')->insert([
            'kode' => $validated['kode'],
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis'],
            'deskripsi_tindakan_terapi' => $this->FormatInput($validated['deskripsi_tindakan_terapi']),
        ]);

        return redirect()->route('admin.tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil ditambahkan.');
    }

    // ======================================================
    // UPDATE
    // ======================================================
    public function update(Request $request, $idkode_tindakan_terapi)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)
            ->update([
                'kode' => $validated['kode'] ?? DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)->value('kode'),
                'idkategori' => $validated['idkategori'] ?? DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)->value('idkategori'),
                'idkategori_klinis' => $validated['idkategori_klinis'] ?? DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)->value('idkategori_klinis'),
                'deskripsi_tindakan_terapi' => !empty($validated['deskripsi_tindakan_terapi'])
                    ? $this->FormatInput($validated['deskripsi_tindakan_terapi'])
                    : DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)->value('deskripsi_tindakan_terapi'),
            ]);

        return redirect()->route('admin.tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil diperbarui.');
    }

    // ======================================================
    // DELETE
    // ======================================================
    public function delete($idkode_tindakan_terapi)
    {
        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $idkode_tindakan_terapi)
            ->delete();

        return redirect()->route('admin.tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil dihapus.');
    }
}
