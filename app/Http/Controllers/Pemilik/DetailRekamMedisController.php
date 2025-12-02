<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis;

class DetailRekamMedisController extends Controller
{
    public function index($idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $detailRekamMedis = DetailRekamMedis::where('idrekam_medis', $idrekam_medis)->get();
        $kodeTindakan = KodeTindakanTerapi::all();
        return view('pemilik.rekam-medis.detail', compact('detailRekamMedis', 'rekamMedis', 'kodeTindakan'));
    }
}
