<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GMRegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'gm_name'     => 'required|string|max:255',
            'gm_email'    => 'required|string|email|max:255|unique:users,email',
            'gm_district' => 'required|string|max:255',
            'gm_password' => 'required|string|min:8',
        ]);

        $district = strtoupper(substr(preg_replace('/\s+/', '', $request->gm_district), 0, 4));
        $count = User::where('role', 'gm')
            ->whereRaw('UPPER(LEFT(REPLACE(district, " ", ""), 4)) = ?', [$district])
            ->count() + 1;
        $gm_id = sprintf('%s_GM_%03d', $district, $count);

        User::create([
            'name'     => $request->gm_name,
            'email'    => $request->gm_email,
            'password' => Hash::make($request->gm_password),
            'role'     => 'gm',
            'district' => $request->gm_district,
            'gm_id'    => $gm_id,
            'status'   => 'approved',
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'GM registered successfully!');
    }
}
