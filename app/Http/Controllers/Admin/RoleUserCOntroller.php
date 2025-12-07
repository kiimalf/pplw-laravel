<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleUserController extends Controller
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
    // Ambil user beserta semua rolenya dalam satu query
    $raw = DB::table('user')
        ->leftJoin('role_user', 'role_user.iduser', '=', 'user.iduser')
        ->leftJoin('role', 'role.idrole', '=', 'role_user.idrole')
        ->select(
            'user.iduser',
            'user.nama',
            'user.email',
            'role_user.idrole_user',
            'role_user.status',
            'role.nama_role'
        )
        ->orderBy('user.iduser')
        ->get();

    // Kelompokkan role-role berdasarkan iduser (mirip eager loading)
    $users = $raw->groupBy('iduser')->map(function ($rows) {
        
        $user = new \stdClass();
        $user->iduser = $rows[0]->iduser;
        $user->nama = $rows[0]->nama;
        $user->email = $rows[0]->email;

        // Buat array mirip $user->roleUser
        $user->roleUser = collect($rows)->filter(function ($r) {
            return $r->idrole_user !== null;
        })->map(function ($r) {
            return (object)[
                'idrole_user' => $r->idrole_user,
                'status' => $r->status,
                'role' => (object)[
                    'nama_role' => $r->nama_role
                ]
            ];
        });

        return $user;
    });

    return view('admin.role-user.index', compact('users'));
}


    public function create()
    {
        return view('admin.role-user.create');
    }

    public function edit($iduser)
    {
        // Ambil data user
        $user = DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) abort(404);

        // Ambil semua role
        $role = DB::table('role')->get();

        // Ambil semua role user + nama role
        $roleUser = DB::table('role_user')
            ->join('role', 'role.idrole', '=', 'role_user.idrole')
            ->where('role_user.iduser', $iduser)
            ->select(
                'role_user.*',
                'role.nama_role'
            )
            ->get();

        return view('admin.role-user.edit', [
            'user' => $user,
            'role' => $role,
            'roleUser' => $roleUser
        ]);
    }


    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::table('role_user')->insert([
            'iduser' => $validated['iduser'],
            'idrole' => $validated['idrole'],
            'status' => 0,
        ]);

        return redirect()
            ->route('admin.role-user.edit', $validated['iduser'])
            ->with('success', 'Role User berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, $idrole_user)
    {
        $roleUser = DB::table('role_user')
            ->where('idrole_user', $idrole_user)
            ->first();

        if (!$roleUser) abort(404);

        $newStatus = $roleUser->status == 0 ? 1 : 0;

        DB::table('role_user')
            ->where('idrole_user', $idrole_user)
            ->update(['status' => $newStatus]);

        return redirect()
            ->route('admin.role-user.edit', $roleUser->iduser)
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function delete($idrole_user)
    {
        $roleUser = DB::table('role_user')
            ->where('idrole_user', $idrole_user)
            ->first();

        if (!$roleUser) abort(404);

        DB::table('role_user')
            ->where('idrole_user', $idrole_user)
            ->delete();

        return redirect()
            ->route('admin.role-user.edit', $roleUser->iduser)
            ->with('success', 'Role User berhasil dihapus.');
    }
}
