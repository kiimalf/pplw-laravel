<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\Pet;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokters = TemuDokter::all();
        return view('dokter.temu-dokter.index', compact('temuDokters'));
    }
}
