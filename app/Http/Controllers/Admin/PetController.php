<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;

class PetController extends Controller
{
    protected function validateData(Request $request, $mode = 'store')
    {
        $rules = [
            'nama_pet' => 'required',
            'tanggal_lahir' => 'required',
            'warna_tanda' => 'required',
            'jenis_kelamin' => 'required',
            'idpemilik' => 'required',
            'idras_hewan' => 'required'
        ];

        if ($mode === 'update') {
            foreach ($rules as &$rule) $rule = 'nullable';
        }

        return $request->validate($rules);
    }
    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    public function index()
    {
        $pets = Pet::all();
        return view('admin.pet.index', compact('pets'));
    }
    public function create()
    {
        $rasHewan = RasHewan::all();
        $pemilik = Pemilik::all();
        return view('admin.pet.create', compact('rasHewan', 'pemilik'));
    }
    public function edit($idpet)
    {
        $pet = Pet::findOrFail($idpet);
        $pemilik = Pemilik::whereNot('idpemilik', $pet->idpemilik)->get();
        $rasHewan = RasHewan::whereNot('idras_hewan', $pet->idras_hewan)->get();
        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        Pet::create([
            'nama' => $this->FormatInput($validated['nama_pet']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => $this->FormatInput($validated['warna_tanda']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan'],
        ]);

        return redirect()->route('admin.pet.index')->with('success', 'pet berhasil ditambahkan.');
    }
    public function update(Request $request, $idpet)
    {
        // Temukan user yang akan diupdate
        $pet = Pet::findOrFail($idpet);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $pet->update([
            'nama' => $this->FormatInput($validated['nama_pet']) ?? $pet->nama,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? $pet->tanggal_lahir,
            'warna_tanda' => $this->FormatInput($validated['warna_tanda']) ?? $pet->warna_tanda,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? $pet->jenis_kelamin,
            'idras_hewan' => $validated['idras_hewan'] ?? $pet->idras_hewan,
        ]);

        return redirect()->route('admin.pet.index')->with('success', 'pet berhasil diperbarui.');
    }
    public function delete($idpet)
    {
        $pet = Pet::findOrFail($idpet);
        $pet->delete();

        return redirect()->route('admin.pet.index')->with('success', 'Pet berhasil dihapus.');
    }
}
