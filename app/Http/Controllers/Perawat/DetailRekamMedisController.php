<?php

namespace App\Http\Controllers\Perawat;

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
        return view('perawat.rekam-medis.detail', compact('detailRekamMedis', 'rekamMedis', 'kodeTindakan'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'idrekam_medis' => 'required',
            'kodeTindakan' => 'required',
            'detail' => 'required'
        ]);

        // Buat user baru
        DetailRekamMedis::create([
            'idrekam_medis' => $validated['idrekam_medis'],
            'idkode_tindakan_terapi' => $validated['kodeTindakan'],
            'detail' => $validated['detail'] ?? '-',
        ]);

        return redirect()->route('perawat.rekam-medis.detail', $validated['idrekam_medis'])->with('success', 'Detail Rekam Medis berhasil ditambahkan.');
    }

    public function delete($iddetail_rekam_medis)
    {
        $detailRekamMedis = DetailRekamMedis::findOrFail($iddetail_rekam_medis);
        $idrekam_medis = $detailRekamMedis->idrekam_medis;
        $detailRekamMedis->delete();

        return redirect()->route('perawat.rekam-medis.detail', $idrekam_medis)->with('success', 'Detail Rekam Medis berhasil dihapus.');
    }
}
