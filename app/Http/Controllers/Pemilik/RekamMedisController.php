<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;

class RekamMedisController extends Controller
{
    public function index()
    {
        $idpemilik = Auth::user()->pemilik->idpemilik;

        $idpet = Pet::where('idpemilik', $idpemilik)->pluck('idpet');

        $rekamMedisS = RekamMedis::whereIn('idpet', $idpet)->get();
        
        return view('pemilik.rekam-medis.index', compact('rekamMedisS'));
    }
}