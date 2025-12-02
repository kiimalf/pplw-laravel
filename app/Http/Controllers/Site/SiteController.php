<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }
    public function home()
    {
        return view('site.home');
    }

    public function about()
    {
        return view('site.about');
    }

    public function layanan()
    {
        return view('site.layananUmum');
    }

    public function struktur()
    {
        return view('site.strukturOrganisasi');
    }

    public function login()
    {
        return view('auth.login');
    }
}
