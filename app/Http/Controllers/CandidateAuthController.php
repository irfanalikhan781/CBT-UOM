<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateAuthController extends Controller
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

        if (Auth::guard('candidate')->attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']])) {
            return redirect()->intended(route('candidate.dashboard'));
        }

        return redirect()->route('candidate.login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('candidate')->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
