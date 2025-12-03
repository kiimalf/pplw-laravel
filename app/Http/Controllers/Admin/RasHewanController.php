<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RasHewan;
use App\Models\jenisHewan;

class RasHewanController extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $uniqueRas = 'unique:ras_hewan,nama_ras';

        $rules = [
            'nama_ras' =>"required|$uniqueRas",
            'jenis_hewan' => 'required',
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

    public function index()
    {
        $rasHewans = RasHewan::all();
        return view('admin.ras-hewan.index', compacT('rasHewans'));
    }
    public function create()
    {   
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }
    public function edit($idras_hewan)
    {
        $rasHewan = RasHewan::findOrFail($idras_hewan);
        $jenisHewan = jenisHewan::whereNot('idjenis_hewan', $rasHewan->idjenis_hewan)->get();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        RasHewan::create([
            'nama_ras' => $this->FormatInput($validated['nama_ras']),
            'idjenis_hewan' => $validated['jenis_hewan'],
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil Ditambahkan');
    }
    public function update(Request $request, $idras_hewan)
    {
        $rasHewan = RasHewan::findOrFail($idras_hewan);

        $validated = $this->validateData($request, 'update');

        $rasHewan->update([
            'nama_ras' => $this->FormatInput($validated['nama_ras']) ?? $rasHewan->nama_ras,
            'idjenis_hewan' => $validated['jenis_hewan']?? $rasHewan->idjenis_hewan,
        ]);
        
        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil DIperbarui');
    }
    public function delete($idras_hewan)
    {
        $rasHewan = RasHewan::findOrFail($idras_hewan);
        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras Berhasil Dihapus');
    }
}
