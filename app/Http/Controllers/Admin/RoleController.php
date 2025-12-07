<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected function validateData(Request $request, $mode = 'store')
    {
        return $request->validate([
            'nama_role' => $mode === 'store' ? 'required' : 'nullable'
        ]);
    }

    protected function FormatInput($input)
    {
        return ucwords(strtolower($input));
    }

    public function index()
    {
        // SELECT * FROM role
        $roles = DB::table('role')->get();

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function edit($idrole)
    {
        // SELECT * FROM role WHERE idrole = ?
        $role = DB::table('role')->where('idrole', $idrole)->first();

        if (!$role) abort(404);

        return view('admin.role.edit', compact('role'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        // INSERT
        DB::table('role')->insert([
            'nama_role' => $this->FormatInput($validated['nama_role']),
        ]);

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, $idrole)
    {
        $validated = $this->validateData($request, 'update');

        // UPDATE
        DB::table('role')
            ->where('idrole', $idrole)
            ->update([
                'nama_role' => $validated['nama_role']
                    ? $this->FormatInput($validated['nama_role'])
                    : DB::table('role')->where('idrole', $idrole)->value('nama_role'),
            ]);

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function delete($idrole)
    {
        // DELETE role
        DB::table('role')->where('idrole', $idrole)->delete();

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
