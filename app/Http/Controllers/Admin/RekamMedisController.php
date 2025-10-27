<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::all();
        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }
}