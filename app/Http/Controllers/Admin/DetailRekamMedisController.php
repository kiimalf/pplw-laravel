<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis;

class DetailRekamMedisController extends Controller
{
    protected function validateData(Request $request)
    {
        $rules = [
            'idrekam_medis' => 'required',
            'kodeTindakan' => 'required',
            'detail' => 'nullable'
        ];
        return $request->validate($rules);
    }
    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    public function index($idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $detailRekamMedis = DetailRekamMedis::where('idrekam_medis', $idrekam_medis)->get();
        $kodeTindakan = KodeTindakanTerapi::all();
        return view('admin.rekam-medis.detail', compact('detailRekamMedis', 'rekamMedis', 'kodeTindakan'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        DetailRekamMedis::create([
            'idrekam_medis' => $validated['idrekam_medis'],
            'idkode_tindakan_terapi' => $validated['kodeTindakan'],
            'detail' => $this->FormatInput($validated['detail']) ?? '-',
        ]);

        return redirect()->route('admin.rekam-medis.detail', $validated['idrekam_medis'])->with('success', 'Detail Rekam Medis berhasil ditambahkan.');
    }

    public function delete($iddetail_rekam_medis)
    {
        $detailRekamMedis = DetailRekamMedis::findOrFail($iddetail_rekam_medis);
        $idrekam_medis = $detailRekamMedis->idrekam_medis;
        $detailRekamMedis->delete();

        return redirect()->route('admin.rekam-medis.detail', $idrekam_medis)->with('success', 'Detail Rekam Medis berhasil dihapus.');
    }
}
