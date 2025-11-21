<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailRekamMedis;

class DetailRekamMedisController extends Controller
{
    public function index()
    {
        $detailRekamMedis = DetailRekamMedis::all();
        return view('admin.detail-rekam-medis.index', compact('detailRekamMedis'));
    }
}
