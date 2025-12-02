<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
    public function create()
    {
        return view('admin.role.create');
    }
    public function edit($idrole)
    {
        $role = Role::findOrFail($idrole);
        return view('admin.role.edit', compact('role'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_role' => 'required'
        ]);

        // Buat user baru
        Role::create([
            'nama_role' => $validated['nama_role'],
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil ditambahkan.');
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

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diperbarui.');
    }
    public function delete($idrole)
    {
        $role = Role::findOrFail($idrole);
        $role->delete();

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil dihapus.');
    }
}
