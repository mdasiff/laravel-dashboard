<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
    	return view('admin.auth.login');
    }
    public function login_post(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        
        return back()->with(['error' => 'Invalid credentials']);

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
