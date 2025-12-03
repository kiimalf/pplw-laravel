<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueEmail ='unique:User,email';
        $rules = [
            'nama' => 'required|string',
            'email' => "required|email|$uniqueEmail",
            'no_wa' => 'required|string',
            'alamat' => 'required|string',
        ];
        if ($mode === 'update') {
            $rules = [
                'nama' => 'nullable|string',
                'email' => "nullable|email|$uniqueEmail",
                'no_wa' => 'nullable|string',
                'alamat' => 'nullable|string',
            ];
        }
        return $request->validate($rules);
    }
    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

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
        $validated = $this->validateData($request);

        // Buat user baru
        User::create([
            'nama' => $this->FormatInput($validated['alamat']),
            'email' => $validated['email'],
            'password' => bcrypt('123456'), // Set password default
        ]);

        Pemilik::create([
            'iduser' => User::where('email', $validated['email'])->first()->iduser,
            'no_wa' => $validated['no_wa'],
            'alamat' => $this->FormatInput($validated['alamat']),
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function update(Request $request, $idpemilik)
    {
        // Temukan user yang akan diupdate
        $pemilik = Pemilik::findOrFail($idpemilik);
        $user = User::findOrFail($pemilik->iduser);

        // Validasi input
        $validated = $this->validateData($request, 'update');

        // Update data user
        $user->update([
            'nama' => $this->FormatInput($validated['nama']) ?? $user->nama,
            'email' => $validated['email'] ?? $user->email,
        ]);

        // Update data pemilik
        $pemilik->update([
            'no_wa' => $validated['no_wa'] ?? $pemilik->no_wa,
            'alamat' => $this->FormatInput($validated['alamat']) ?? $pemilik->alamat,
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
