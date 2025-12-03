<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\Pet;

class TemuDokterController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueTemuDokter = 'unique:temu_dokter,no_urut';
        $rules = [
            'no_urut' => "required|$uniqueTemuDokter",
            'idpet' => 'required',
            'idrole_user' => 'required'
        ];
        if ($mode === 'update') {
            $rules = [
                'no_urut' => 'nullable',
                'idpet' => 'nullable',
                'idrole_user' => 'nullable'
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
        $temuDokters = TemuDokter::all();
        return view('admin.temu-dokter.index', compact('temuDokters'));
    }
    public function create()
    {   
        $dokters = RoleUser::where('idrole', '2')->where('status', '1')->get();
        $pets = Pet::all();
        return view('admin.temu-dokter.create', compact('dokters', 'pets'));
    }
    public function edit($idreservasi_dokter)
    {
        $temuDokter = TemuDokter::findOrFail($idreservasi_dokter);
        $dokters = Roleuser::where('idrole', '2')->where('status', '1')->whereNot('idrole_user', $temuDokter->idrole_user)->get();
        return view('admin.temu-dokter.edit', compact('temuDokter', 'dokters'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        TemuDokter::create([
            'no_urut' => $validated['no_urut'],
            'status' => '0',
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'waktu_daftar' => now(),
        ]);

        return redirect()->route('admin.temu-dokter.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }
    public function update(Request $request, $idreservasi_dokter)
    {
        // Temukan user yang akan diupdate
        $temuDokter = TemuDokter::findOrFail($idreservasi_dokter);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $temuDokter->update([
            'status' => $validated['status'] ?? $temuDokter->status,
            'idrole_user' => $validated['idrole_user'] ?? $temuDokter->idrole_user,
        ]);

        return redirect()->route('admin.temu-dokter.index')->with('success', 'Role berhasil diperbarui.');
    }
    public function delete($idreservasi_dokter)
    {
        $temuDokter = TemuDokter::findOrFail($idreservasi_dokter);
        $temuDokter->delete();

        return redirect()->route('admin.temu-dokter.index')->with('success', 'Role berhasil dihapus.');
    }
    
}
