<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueEmail = 'unique:user,email';

        if ($mode === 'update') {
            $uniqueEmail .= ',' . $request->iduser . ',iduser';
        }

        return $request->validate([
            'nama'   => $mode === 'create' ? 'required|string' : 'nullable|string',
            'email'  => $mode === 'create' ? "required|email|$uniqueEmail" : "nullable|email",
            'no_wa'  => $mode === 'create' ? 'required|string' : 'nullable|string',
            'alamat' => $mode === 'create' ? 'required|string' : 'nullable|string',
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    /**
     * INDEX (JOIN user + pemilik)
     */
    public function index()
    {
        $pemiliks = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->get();

        return view('admin.pemilik.index', compact('pemiliks'));
    }

    /**
     * CREATE VIEW
     */
    public function create()
    {
        return view('admin.pemilik.create');
    }

    /**
     * EDIT (JOIN user)
     */
    public function edit($idpemilik)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $idpemilik)->first();

        if (!$pemilik) abort(404);

        $user = DB::table('user')
            ->where('iduser', $pemilik->iduser)
            ->first();

        return view('admin.pemilik.edit', compact('pemilik', 'user'));
    }

    /**
     * STORE (INSERT user + pemilik)
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        // Insert user
        $iduser = DB::table('user')->insertGetId([
            'nama'     => $this->FormatInput($validated['nama']),
            'email'    => $validated['email'],
            'password' => bcrypt('123456'), // Default password
        ]);

        // Insert pemilik
        DB::table('pemilik')->insert([
            'iduser' => $iduser,
            'no_wa'  => $validated['no_wa'],
            'alamat' => $this->FormatInput($validated['alamat']),
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil ditambahkan.');
    }

    /**
     * UPDATE (UPDATE user + pemilik)
     */
    public function update(Request $request, $idpemilik)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $idpemilik)->first();
        if (!$pemilik) abort(404);

        $validated = $this->validateData($request, 'update');

        // Update user
        DB::table('user')->where('iduser', $pemilik->iduser)->update([
            'nama'  => $validated['nama']   ? $this->FormatInput($validated['nama']) : DB::raw('nama'),
            'email' => $validated['email']  ?? DB::raw('email'),
        ]);

        // Update pemilik
        DB::table('pemilik')->where('idpemilik', $idpemilik)->update([
            'no_wa'  => $validated['no_wa']  ?? DB::raw('no_wa'),
            'alamat' => $validated['alamat'] ? $this->FormatInput($validated['alamat']) : DB::raw('alamat'),
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil diperbarui.');
    }

    /**
     * DELETE (DELETE pemilik + user)
     */
    public function delete($idpemilik)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $idpemilik)->first();
        if (!$pemilik) abort(404);

        // Delete pemilik
        DB::table('pemilik')->where('idpemilik', $idpemilik)->delete();

        // Delete user
        DB::table('user')->where('iduser', $pemilik->iduser)->delete();

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil dihapus.');
    }
}
