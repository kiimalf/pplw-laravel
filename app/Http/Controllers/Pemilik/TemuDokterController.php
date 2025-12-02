<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\Pet;

class TemuDokterController extends Controller
{
    public function index()
    {
        $idpemilik = Auth::user()->pemilik->idpemilik;

        $idpet = Pet::where('idpemilik', $idpemilik)->pluck('idpet');

        $temuDokters = TemuDokter::whereIn('idpet', $idpet)->get();
        return view('pemilik.temu-dokter.index', compact('temuDokters'));
    }
}
