<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $idpemilik = Auth::user()->pemilik->idpemilik;

        $pets = Pet::where('idpemilik', $idpemilik)->get();
        
        return view('pemilik.pet.index', compact('pets'));
    }
    
}
