<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemuDokterController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueTemuDokter = 'unique:temu_dokter,no_urut';

        if ($mode === 'create') {
            $rules = [
                'no_urut' => "required|$uniqueTemuDokter",
                'idpet' => 'required',
                'idrole_user' => 'required'
            ];
        }

        else {
            $rules = [
                'idrole_user' => 'nullable',
                'status' => 'nullable'
            ];
        }

        
        return $request->validate($rules);
    }

    public function index()
    {
        $temuDokters = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                't.*',
                'p.nama as nama_pet',
                'u.nama as nama_dokter'
            )
            ->orderBy('t.no_urut')
            ->get();

        return view('admin.temu-dokter.index', compact('temuDokters'));
    }

    public function create()
    {
        // Dokter adalah role_user dengan idrole = 2 dan status aktif = 1
        $dokters = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->select('ru.idrole_user', 'u.nama')
            ->get();

        $pets = DB::table('pet')->select('idpet', 'nama')->get();

        return view('admin.temu-dokter.create', compact('dokters', 'pets'));
    }

    public function edit($idreservasi_dokter)
    {
        $temuDokter = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                't.*',
                'p.nama as nama_pet',
                'ru.idrole_user',
                'u.nama as nama_dokter'
            )
            ->where('t.idreservasi_dokter', $idreservasi_dokter)
            ->first();

        // Ambil dokter lain selain yang sekarang
        $dokters = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->where('ru.idrole_user', '!=', $temuDokter->idrole_user)
            ->select('ru.idrole_user', 'u.nama')
            ->get();

        return view('admin.temu-dokter.edit', compact('temuDokter', 'dokters'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('temu_dokter')->insert([
            'no_urut' => $validated['no_urut'],
            'status' => '0',
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'waktu_daftar' => now(),
        ]);

        return redirect()->route('admin.temu-dokter.index')
                         ->with('success', 'Reservasi berhasil ditambahkan.');
    }

    public function update(Request $request, $idreservasi_dokter)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $idreservasi_dokter)
            ->update([
                'status' => $validated['status'] ?? DB::raw('status'),
                'idrole_user' => $validated['idrole_user'] ?? DB::raw('idrole_user'),
            ]);

        return redirect()->route('admin.temu-dokter.index')
                         ->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function delete($idreservasi_dokter)
    {
        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $idreservasi_dokter)
            ->delete();

        return redirect()->route('admin.temu-dokter.index')
                         ->with('success', 'Reservasi berhasil dihapus.');
    }
}
