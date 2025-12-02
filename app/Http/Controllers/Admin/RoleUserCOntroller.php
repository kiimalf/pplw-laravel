<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;

class RoleUserCOntroller extends Controller
{
    public function index()
    {
        $roleuser = RoleUser::with('user', 'role')->get()->groupBy('iduser'); // mengelompokkan per user
        return view('admin.role-user.index', compact ('roleuser'));
    }
    public function create()
    {
        return view('admin.role-user.create');
    }
    public function edit($idrole_user)
    {
        $roleuser = RoleUser::findOrFail($idrole_user);
        return view('admin.role-user.edit', compact('roleuser'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'iduser' => 'required',
            'idrole' => 'required',
            'status' => 'nullable'
        ]);

        // Buat user baru
        Role::create([
            'iduser' => $validated['iduser'],
            'idrole' => $validated['idrole'],
            'status' => $validated['status'] ?? '0',
        ]);

        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil ditambahkan.');
    }
    public function update(Request $request, $idrole)
    {
        // Temukan user yang akan diupdate
        $role = Role::findOrFail($idrole);

        // Validasi input
        $validated = $request->validate([
            'nama_role' => 'nullable|string|max:255',
        ]);

        // Update data user
        $role->update([
            'nama_role' => $validated['nama_role'] ?? $role->nama_role,
        ]);

        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil diperbarui.');
    }
    public function delete($idrole)
    {
        $role = Role::findOrFail($idrole);
        $role->delete();

        return redirect()->route('admin.role-user.index')->with('success', 'Role User berhasil dihapus.');
    }
}
