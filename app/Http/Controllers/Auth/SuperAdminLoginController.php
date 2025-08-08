<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Add role check
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => 'superadmin'])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Logged in as Super Admin!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not a Super Admin.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
