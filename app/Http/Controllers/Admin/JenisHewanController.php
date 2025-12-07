<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    protected function validateData(Request $request, $mode = 'store')
    {
        $uniqueJenis = 'unique:jenis_hewan,nama_jenis_hewan';

        return $request->validate([
            'nama_jenis_hewan' => $mode === 'store' ? "required|$uniqueJenis" : 'nullable'
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    /**
     * INDEX
     */
    public function index()
    {
        $jenisHewans = DB::table('jenis_hewan')->get();

        return view('admin.jenis-hewan.index', compact('jenisHewans'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    /**
     * EDIT
     */
    public function edit($idjenis_hewan)
    {
        $jenisHewan = DB::table('jenis_hewan')
            ->where('idjenis_hewan', $idjenis_hewan)
            ->first();

        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $this->FormatInput($validated['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $idjenis_hewan)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $idjenis_hewan)
            ->update([
                'nama_jenis_hewan' => $validated['nama_jenis_hewan']
                    ? $this->FormatInput($validated['nama_jenis_hewan'])
                    : DB::raw('nama_jenis_hewan'),
            ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function delete($idjenis_hewan)
    {
        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $idjenis_hewan)
            ->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil dihapus.');
    }
}
