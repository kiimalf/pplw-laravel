<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::all();
        return view('admin.pemilik.index', compact('pemiliks'));
    }
     public function create()
    {
        return view('admin.pemilik.create');
    }

    public function edit($idpemilik)
    {
        $pemilik = Pemilik::findOrFail($idpemilik);
        $user = User::findOrFail($pemilik->iduser);
        return view('admin.pemilik.edit', compact('pemilik', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:User,email',
            'no_wa' => 'required',
            'alamat' => 'required',
        ]);

        // Buat user baru
        User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => bcrypt('123456'), // Set password default
        ]);

        Pemilik::create([
            'iduser' => User::where('email', $validated['email'])->first()->iduser,
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function update(Request $request, $idpemilik)
    {
        // Temukan user yang akan diupdate
        $pemilik = Pemilik::findOrFail($idpemilik);
        $user = User::findOrFail($pemilik->iduser);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:User,email,'.$user->iduser.',iduser',
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        // Update data user
        $user->update([
            'nama' => $validated['nama'] ?? $user->nama,
            'email' => $validated['email'] ?? $user->email,
        ]);

        // Update data pemilik
        $pemilik->update([
            'no_wa' => $validated['no_wa'] ?? $pemilik->no_wa,
            'alamat' => $validated['alamat'] ?? $pemilik->alamat,
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil diperbarui.');
    }

    public function delete($idpemilik)
    {
        $pemilik = Pemilik::findOrFail($idpemilik);
        $user = User::findOrFail($pemilik->iduser);
        $pemilik->delete();
        $user->delete();

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil dihapus.');
    }
}
