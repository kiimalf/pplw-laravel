<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueRekamMedis = 'unique:rekam_medis,idreservasi_dokter';

        $rules = [
            'idreservasi_dokter' => "required|$uniqueRekamMedis",
            'anamnesa' => 'required',
            'diagnosa' => 'required',
            'temuan_klinis' => 'required',
            'dokter_pemeriksa' => 'required'
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
        $rekamMedisS = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet as p', 'rm.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 'rm.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                'rm.*',
                'td.no_urut',
                'p.nama as nama_pet',
                'u.nama as nama_dokter'
            )
            ->orderBy('rm.created_at', 'DESC')
            ->get();

        return view('admin.rekam-medis.index', compact('rekamMedisS'));
    }

    public function create()
    {
        // Semua reservasi yang BELUM punya rekam medis
        $reservasi = DB::table('temu_dokter as td')
            ->leftJoin('rekam_medis as rm', 'td.idreservasi_dokter', '=', 'rm.idreservasi_dokter')
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->select('td.idreservasi_dokter', 'td.no_urut', 'p.nama as nama_pet')
            ->whereNull('rm.idreservasi_dokter')
            ->orderBy('td.no_urut')
            ->get();

        $dokter = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->select('ru.idrole_user', 'u.nama')
            ->get();

        return view('admin.rekam-medis.create', compact('reservasi', 'dokter'));
    }

    public function edit($idrekam_medis)
    {
        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet as p', 'rm.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 'rm.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                'rm.*',
                'td.no_urut',
                'p.nama as nama_pet',
                'u.nama as nama_dokter'
            )
            ->where('rm.idrekam_medis', $idrekam_medis)
            ->first();

        // list dokter lain
        $dokter = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->where('ru.idrole_user', '!=', $rekamMedis->dokter_pemeriksa)
            ->select('ru.idrole_user', 'u.nama')
            ->get();

        // reservasi lain
        $reservasi = DB::table('temu_dokter')
            ->where('idreservasi_dokter', '!=', $rekamMedis->idreservasi_dokter)
            ->get();

        return view('admin.rekam-medis.edit', compact('rekamMedis', 'dokter', 'reservasi'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        // Ambil idpet dari tabel temu_dokter
        $pet = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $validated['idreservasi_dokter'])
            ->value('idpet');

        DB::table('rekam_medis')->insert([
            'idreservasi_dokter' => $validated['idreservasi_dokter'],
            'idpet' => $pet,
            'anamnesa' => $this->FormatInput($validated['anamnesa']),
            'diagnosa' => $this->FormatInput($validated['diagnosa']),
            'temuan_klinis' => $this->FormatInput($validated['temuan_klinis']),
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'],
            'created_at' => now()
        ]);

        return redirect()->route('admin.rekam-medis.index')
                         ->with('success', 'Rekam Medis berhasil ditambahkan.');
    }

    public function update(Request $request, $idrekam_medis)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->update([
                'idreservasi_dokter' => $validated['idreservasi_dokter'] ?? DB::raw('idreservasi_dokter'),
                'idpet' => $validated['idpet'] ?? DB::raw('idpet'),
                'anamnesa' => $validated['anamnesa'] ? $this->FormatInput($validated['anamnesa']) : DB::raw('anamnesa'),
                'diagnosa' => $validated['diagnosa'] ? $this->FormatInput($validated['diagnosa']) : DB::raw('diagnosa'),
                'temuan_klinis' => $validated['temuan_klinis'] ? $this->FormatInput($validated['temuan_klinis']) : DB::raw('temuan_klinis'),
                'dokter_pemeriksa' => $validated['dokter_pemeriksa'] ?? DB::raw('dokter_pemeriksa'),
            ]);

        return redirect()->route('admin.rekam-medis.index')
                         ->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    public function delete($idrekam_medis)
    {
        DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->delete();

        return redirect()->route('admin.rekam-medis.index')
                         ->with('success', 'Rekam Medis berhasil dihapus.');
    }
}
