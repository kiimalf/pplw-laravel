<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedisS = RekamMedis::all();
        return view('admin.rekam-medis.index', compact('rekamMedisS'));
    }
    public function create()
    {
        $reservasi = TemuDokter::all();
        $pet = Pet::all();
        $dokter = RoleUser::where('idrole', '2')->where('status', '1')->get();
        return view('admin.rekam-medis.create', compact('reservasi', 'pet', 'dokter'));
    }

    public function edit($idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $dokter = RoleUser::where('idrole', '2')->where('status', '1')->whereNot('idrole_user', $rekamMedis->dokter_pemeriksa)->get();
        $pet = Pet::whereNot('idpet', $rekamMedis->idpet)->get();
        $reservasi = TemuDokter::whereNot('idreservasi_dokter', $rekamMedis->idreservasi_dokter)->get();
        return view('admin.rekam-medis.edit', compact('rekamMedis', 'dokter', 'pet', 'reservasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required',
            'diagnosa' => 'required',
            'temuan_klinis' => 'required',
            'dokter_pemeriksa' => 'required'
        ]);
        $pet = TemuDokter::findOrFail($validated['idreservasi_dokter'])->idpet;
        // Buat user baru
        RekamMedis::create([
            'idreservasi_dokter' => $validated['idreservasi_dokter'],
            'idpet' => $pet,
            'anamnesa' => $validated['anamnesa'],
            'diagnosa' => $validated['diagnosa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'],
            'created_at' => now(),
        ]);

        return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam Medis berhasil ditambahkan.');
    }
    public function update(Request $request, $idrekam_medis)
    {
        // Temukan user yang akan diupdate
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);

        // Validasi input
        $validated = $request->validate([
            'idreservasi_dokter' => 'nullable',
            'idpet' => 'nullable',
            'anamnesa' => 'nullable',
            'diagnosa' => 'nullable',
            'temuan_klinis' => 'nullable',
            'dokter_pemeriksa' => 'nullable'
        ]);

        // Update data rekam medis
        $rekamMedis->update([
            'idreservasi_dokter' => $validated['idreservasi_dokter'] ?? $rekamMedis->idreservasi_dokter,
            'idpet' => $validated['idpet'] ?? $rekamMedis->idpet,
            'anamnesa' => $validated['anamnesa'] ?? $rekamMedis->anamnesa,
            'diagnosa' => $validated['diagnosa'] ?? $rekamMedis->diagnosa,
            'temuan_klinis' => $validated['temuan_klinis'] ?? $rekamMedis->temuan_klinis,
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'] ?? $rekamMedis->dokter_pemeriksa,
        ]);

        return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    public function delete($idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $rekamMedis->delete();

        return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam Medis berhasil dihapus.');
    }
}