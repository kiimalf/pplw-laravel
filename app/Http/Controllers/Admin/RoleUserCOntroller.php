<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class RoleUserCOntroller extends Controller
{
    public function index()
    {
        $roleuser = User::with('roles')->get();

        return view('admin.role-user.index', compact ('roleuser'));
    }
}
