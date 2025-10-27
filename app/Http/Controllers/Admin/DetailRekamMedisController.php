<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RekamMedis;

class DetailRekamMedisController extends Controller
{
    public function index()
    {
        $detailRekamMedis = RekamMedis::with('kode_tindakan_terapi')->get();
        return view('admin.detail-rekam-medis.index', compact('detailRekamMedis'));
    }
}
