<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    protected function validateData(Request $request, $mode = 'store')
    {
        $rules = [
            'nama_pet'      => 'required',
            'tanggal_lahir' => 'required',
            'warna_tanda'   => 'required',
            'jenis_kelamin' => 'required',
            'idpemilik'     => 'required',
            'idras_hewan'   => 'required'
        ];

        if ($mode === 'update') {
            foreach ($rules as &$rule) $rule = 'nullable';
        }

        return $request->validate($rules);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    /**
     * INDEX — JOIN PET + PEMILIK + RAS + JENIS HEWAN
     */
    public function index()
    {
        $pets = DB::table('pet')
            ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->join('ras_hewan', 'ras_hewan.idras_hewan', '=', 'pet.idras_hewan')
            ->select(
                'pet.*',
                'user.nama as nama_pemilik',
                'ras_hewan.nama_ras'
            )
            ->get();

        return view('admin.pet.index', compact('pets'));
    }


    /**
     * CREATE — LOAD RAS & PEMILIK
     */
    public function create()
    {
        $pemilik = DB::table('pemilik')
        ->join('user', 'user.iduser', '=', 'pemilik.iduser')
        ->select(
            'pemilik.*',
            'user.nama as nama_pemilik'
        )->get();
        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        return view('admin.pet.create', compact('rasHewan', 'pemilik'));
    }

    /**
     * EDIT — LOAD DETAIL + DROPDOWN
     */
    public function edit($idpet)
    {
        $pet = DB::table('pet')->where('idpet', $idpet)->first();
        if (!$pet) abort(404);

        $pemilik = DB::table('pemilik')
            ->whereNot('idpemilik', $pet->idpemilik)
            ->get();

        $rasHewan = DB::table('ras_hewan')
            ->whereNot('idras_hewan', $pet->idras_hewan)
            ->get();

        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    /**
     * STORE — INSERT PET
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('pet')->insert([
            'nama'          => $this->FormatInput($validated['nama_pet']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda'   => $this->FormatInput($validated['warna_tanda']),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik'     => $validated['idpemilik'],
            'idras_hewan'   => $validated['idras_hewan'],
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil ditambahkan.');
    }

    /**
     * UPDATE
    */
    public function update(Request $request, $idpet)
    {
        $pet = DB::table('pet')->where('idpet', $idpet)->first();
        if (!$pet) abort(404);

        $validated = $this->validateData($request, 'update');

        DB::table('pet')->where('idpet', $idpet)->update([
            'nama'          => $validated['nama_pet'] ? $this->FormatInput($validated['nama_pet']) : DB::raw('nama'),
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? DB::raw('tanggal_lahir'),
            'warna_tanda'   => $validated['warna_tanda'] ? $this->FormatInput($validated['warna_tanda']) : DB::raw('warna_tanda'),
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? DB::raw('jenis_kelamin'),
            'idras_hewan'   => $validated['idras_hewan'] ?? DB::raw('idras_hewan'),
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function delete($idpet)
    {
        DB::table('pet')->where('idpet', $idpet)->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil dihapus.');
    }
}
