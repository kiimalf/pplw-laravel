<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::all();
        return view('admin.pet.index', compact('pet'));
    }
}
