<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $role_user = $request->User()->roleUser()->where('status', '1')->first();
        $role = $role_user->role->nama_role;


        return match ($role) {
            'Administrator' => redirect()->route('admin.dashboard'),
            'Dokter'=> redirect()->route('dokter.dashboard'),
            'Perawat'=> redirect()->route('perawat.dashboard'),
            'Resepsionis'   => redirect()->route('resepsionis.dashboard'),
            'Pemilik'       => redirect()->route('pemilik.dashboard'),
            default         => redirect()->route('dashboard'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
