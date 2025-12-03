<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;

class RoleUserCOntroller extends Controller
{
    protected function validateData(Request $request, $mode = 'create')
    {
        $rules = [
            'iduser' => 'required',
            'idrole' => 'required',
        ];
        if ($mode === 'update') {
            $rules = [
                'status' => 'nullable'
            ];
        }
        return $request->validate($rules);
    }

    public function index()
    {
        $users = User::with('roleUser.role')->get();
        return view('admin.role-user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.role-user.create');
    }
    public function edit($iduser)
    {
        $user = User::with(['roleUser.role'])->findOrFail($iduser);
        $role = Role::all();
        return view('admin.role-user.edit', compact('user', 'role'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateData($request);

        // Buat user baru
        RoleUser::create([
            'iduser' => $validated['iduser'],
            'idrole' => $validated['idrole'],
            'status' => '0',
        ]);

        return redirect()->route('admin.role-user.edit', $validated['iduser'])->with('success', 'Role User berhasil ditambahkan.');
    }
    public function updateStatus(Request $request, $idrole_user)
    {
        // Temukan user yang akan diupdate
        $roleUser = RoleUser::findOrFail($idrole_user);

        $status = $roleUser->status;

        if ($status == '0')
        {
            $roleUser->update([
                'status' => '1',
            ]);
        }
        else
        {
            $roleUser->update([
                'status' => '0',
            ]);
        }

        return redirect()->route('admin.role-user.edit', $roleUser->user->iduser)->with('success', 'Role User berhasil diperbarui.');
    }
    public function delete($idrole_user)
    {
        $roleUser = RoleUser::findOrFail($idrole_user);
        $roleUser->delete();

        return redirect()->route('admin.role-user.edit', $roleUser->user->iduser)->with('success', 'Role User berhasil dihapus.');
    }



}
