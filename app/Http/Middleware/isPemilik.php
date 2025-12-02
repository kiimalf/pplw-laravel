<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_user = $request->user()
            ->roleUser()
            ->where('status', 1)
            ->with('role')
            ->first();

        if (!$role_user || !$role_user->role) {
            return back()->with('error', 'Role tidak ditemukan atau tidak aktif.');
        }

        $role = $role_user->role->nama_role;

        if ($role === 'Pemilik') {
            return $next($request);
        }

        return back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
