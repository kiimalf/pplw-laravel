<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_user = $request->user()->roleUser()->where('status', '1')->first();
        $role = $role_user->role->nama_role;
        
        if ($role == 'Administrator') {
            return $next($request);
        } else {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
