<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.Registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'superadmin', // This is the key line!
            'status'   => 'approved', // Add this line
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Super Admin registered and logged in!');
    }
}
