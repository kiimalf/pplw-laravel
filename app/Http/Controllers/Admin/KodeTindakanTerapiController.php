<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueKode ='unique:kode_tindakan_terapi,kode';
        $rules = [
            'kode' => "required|$uniqueKode",
            'idkategori' => 'required',
            'idkategori_klinis' => 'required',
            'deskripsi_tindakan_terapi' => 'required',
        ];
        if ($mode === 'update') {
            $rules = [
                'kode' => "nullable|$uniqueKode",
                'idkategori' => 'nullable',
                'idkategori_klinis' => 'nullable',
                'deskripsi_tindakan_terapi' => 'nullable',
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
        $kodeTindakanTerapi = KodeTindakanTerapi::all();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }
    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }
    public function edit($idkode_tindakan_terapi)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
        $kategori = Kategori::whereNot('idkategori', $kodeTindakanTerapi->idkategori)->get();
        $kategoriKlinis = KategoriKlinis::whereNot('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis)->get();

        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        KodeTindakanTerapi::create([
            'kode' => $validated['kode'],
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis'],
            'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'],
        ]);

        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Kode Tindakan Terapi berhasil ditambahkan.');
    }
    public function update(Request $request, $idkode_tindakan_terapi)
    {
        // Temukan user yang akan diupdate
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $kodeTindakanTerapi->update([
            'kode' => $validated['kode'] ?? $kodeTindakanTerapi->kode,
            'idkategori' => $validated['idkategori'] ?? $kodeTindakanTerapi->idkategori,
            'idkategori_klinis' => $validated['idkategori_klinis'] ?? $kodeTindakanTerapi->idkategori_klinis,
            'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'] ?? $kodeTindakanTerapi->deskripsi_tindakan_terapi,
        ]);

        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Kode Tindakan Terapi berhasil diperbarui.');
    }
    public function delete($idkode_tindakan_terapi)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($idkode_tindakan_terapi);
        $kodeTindakanTerapi->delete();

        return redirect()->route('admin.tindakan-terapi.index')->with('success', 'Kode Tindakan Terapi berhasil dihapus.');
    }
}
