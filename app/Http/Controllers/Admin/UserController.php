<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function edit($iduser)
    {
        $user = User::findOrFail($iduser);
        return view('admin.user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:3',
        ]);
        // Buat user baru
        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }
    public function update(Request $request, $iduser)
    {
        // Temukan user yang akan diupdate
        $user = User::findOrFail($iduser);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:user,email,' . $iduser . ',iduser',
            'password' => 'nullable|string|min:3',
        ]);

        // Update data user
        $user->update([
            'nama' => $validated['nama'] ?? $user->nama,
            'email' => $validated['email'] ?? $user->email,
            'password' => !empty($validated['password']) ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }
    public function delete($iduser)
    {
        $user = User::findOrFail($iduser);

        if(method_exists($user, 'roles')){
            $user->roles()->detach();
        } elseif(method_exists($user, 'pemilik')) {
            dd($user);
        }
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
