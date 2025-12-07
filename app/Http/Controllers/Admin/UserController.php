<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // SELECT * FROM user
        $users = DB::table('user')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($iduser)
    {
        // SELECT * FROM user WHERE iduser = ?
        $user = DB::table('user')->where('iduser', $iduser)->first();

        if (!$user) {
            abort(404);
        }

        return view('admin.user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);

        // INSERT INTO user (...)
        DB::table('user')->insert([
            'nama'     => $this->formatNama($validated['nama']),
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $iduser)
    {
        $validated = $this->validateUser($request, $iduser);

        $user = DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) {
            abort(404);
        }

        // Jika password kosong, tetap pakai password lama
        $password = $validated['password']
            ? bcrypt($validated['password'])
            : $user->password;

        // UPDATE user
        DB::table('user')->where('iduser', $iduser)->update([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'password' => $password,
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function delete($iduser)
    {
        // delete relasi dari role_user jika ada
        DB::table('role_user')->where('iduser', $iduser)->delete();

        // delete pemilik jika ada
        DB::table('pemilik')->where('iduser', $iduser)->delete();

        // delete user
        DB::table('user')->where('iduser', $iduser)->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    private function validateUser(Request $request, $iduser = null)
    {
        $uniqueEmail = 'unique:user,email';

        if ($iduser) {
            // unique:user,email,4,iduser
            $uniqueEmail .= ',' . $iduser . ',iduser';
        }

        return $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => "required|string|email|max:255|$uniqueEmail",
            'password' => $iduser ? 'nullable|string|min:3' : 'required|string|min:3',
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower($nama));
    }
}
