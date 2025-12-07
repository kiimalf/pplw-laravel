<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboard extends Controller
{
    public function index()
    {
        // --- STATISTIK UTAMA ---
        $totalPets = DB::table('pet')->count();

        $totalOwners = DB::table('pemilik')->count();

        $totalDoctors = DB::table('role_user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->count();

        $waitingReservasi = DB::table('temu_dokter')
            ->where('status', 0)
            ->count();

        $totalReservasiToday = DB::table('temu_dokter')
            ->whereDate('waktu_daftar', today())
            ->count();

        $rekamMedisCount = DB::table('rekam_medis')->count();


        // --- RESERVASI TERBARU (5) ---
        $recentReservasi = DB::table('temu_dokter as td')
            ->join('pet as p', 'p.idpet', '=', 'td.idpet')
            ->select('td.idreservasi_dokter', 'td.no_urut', 'td.status', 'p.nama as nama_pet')
            ->orderBy('td.idreservasi_dokter', 'desc')
            ->limit(5)
            ->get();

        // --- REKAM MEDIS TERBARU (5) ---
        $recentRekamMedis = DB::table('rekam_medis as rm')
            ->join('pet as p', 'p.idpet', '=', 'rm.idpet')
            ->join('role_user as ru', 'ru.idrole_user', '=', 'rm.dokter_pemeriksa')
            ->join('user as u', 'u.iduser', '=', 'ru.iduser')
            ->select(
                'rm.idrekam_medis',
                'p.nama as nama_pet',
                'u.nama as dokter'
            )
            ->orderBy('rm.idrekam_medis', 'desc')
            ->limit(5)
            ->get();

        // KIRIM KE VIEW
        return view('admin.dashboard', compact(
            'totalPets',
            'totalOwners',
            'totalDoctors',
            'totalReservasiToday',
            'waitingReservasi',
            'rekamMedisCount',
            'recentReservasi',
            'recentRekamMedis'
        ));
    }

}
