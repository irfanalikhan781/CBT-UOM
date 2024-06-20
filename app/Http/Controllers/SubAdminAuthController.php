<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubAdminAuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');
        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::guard('sub_admin')->attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']])) {
            return redirect()->intended(route('subadmin.dashboard'));
        }

        return redirect()->route('subadmin.login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('sub_admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
