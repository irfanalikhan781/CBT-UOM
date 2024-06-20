<?php

// app/Http/Controllers/AdminAuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            return redirect()->intended(route('admin.dashboard'));
        }

        // Authentication failed
        return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }
    public function logout(Request $request)
    {

        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }

}
