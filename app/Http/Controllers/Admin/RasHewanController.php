<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasHewanController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $rules = [
            'nama_ras' => "required|unique:ras_hewan,nama_ras",
            'jenis_hewan' => 'required',
        ];

        if ($mode === 'update') {
            $rules = [
                'nama_ras' => 'nullable',
                'jenis_hewan' => 'nullable',
            ];
        }

        return $request->validate($rules);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    /**
     * INDEX: JOIN ras_hewan + jenis_hewan
     */
    public function index()
    {
        $rasHewans = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.*',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->get();

        return view('admin.ras-hewan.index', compact('rasHewans'));
    }

    /**
     * CREATE: Ambil semua jenis hewan
     */
    public function create()
    {
        $jenisHewan = DB::table('jenis_hewan')->get();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    /**
     * EDIT: JOIN satu record ras
     */
    public function edit($idras_hewan)
    {
        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.*',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->where('ras_hewan.idras_hewan', $idras_hewan)
            ->first();

        // ambil list jenis hewan lain untuk dropdown
        $jenisHewan = DB::table('jenis_hewan')
            ->where('idjenis_hewan', '!=', $rasHewan->idjenis_hewan)
            ->get();

        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('ras_hewan')->insert([
            'nama_ras' => $this->FormatInput($validated['nama_ras']),
            'idjenis_hewan' => $validated['jenis_hewan'],
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil Ditambahkan');
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $idras_hewan)
    {
        $validated = $this->validateData($request, 'update');

        DB::table('ras_hewan')
            ->where('idras_hewan', $idras_hewan)
            ->update([
                'nama_ras' => $validated['nama_ras']
                    ? $this->FormatInput($validated['nama_ras'])
                    : DB::raw('nama_ras'),
                'idjenis_hewan' => $validated['jenis_hewan']
                    ?? DB::raw('idjenis_hewan'),
            ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil Diperbarui');
    }

    /**
     * DELETE
     */
    public function delete($idras_hewan)
    {
        DB::table('ras_hewan')->where('idras_hewan', $idras_hewan)->delete();

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil Dihapus');
    }
}
