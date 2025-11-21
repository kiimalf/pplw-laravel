<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::all();
        return view('admin.pemilik.index', compact('pemiliks'));
    }
}
