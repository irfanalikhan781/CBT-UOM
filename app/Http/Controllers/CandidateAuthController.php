<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateAuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('Candidate.candidate-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('candidate')->attempt($request->only('username', 'password'))) {
            return redirect()->route('candidate.dashboard');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials.']);

    }

    public function logout(Request $request)
    {
        Auth::guard('candidate')->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
