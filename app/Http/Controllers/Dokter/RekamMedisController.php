<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedisS = RekamMedis::all();
        return view('dokter.rekam-medis.index', compact('rekamMedisS'));
    }
}