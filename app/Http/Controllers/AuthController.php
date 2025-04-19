<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Developer;

class AuthController extends Controller
{
    // Onyesha fomu ya login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Credentials not matched.',
        ]);
    }

    // Onyesha fomu ya register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Process registration
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:developers',
            'email'    => 'required|email|unique:developers',
            'password' => 'required|min:6|confirmed',
        ]);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Create developer
        $developer = Developer::create($data);

        // Login immediately
        Auth::login($developer);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
