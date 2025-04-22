<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Developer;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login attempt.
     */
    public function login(Request $request)
    {
        // Validate incoming request
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Redirect to dashboard with success message
            return redirect()
                ->route('dashboard')
                ->with('status', 'Login successful.');
        }

        // On failure, redirect back with input and error message
        return back()
            ->withInput($request->only('email'))
            ->with('status', 'Invalid credentials.');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // Validate incoming request
        $data = $request->validate([
            'username'              => 'required|string|unique:developers',
            'email'                 => 'required|email|unique:developers',
            'password'              => 'required|min:6|confirmed',
        ]);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create the developer account
        $developer = Developer::create($data);

        // Log the new developer in
        Auth::login($developer);

        // Redirect to dashboard with success message
        return redirect()
            ->route('dashboard')
            ->with('status', 'Registration successful.');
    }

    /**
     * Log the developer out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login with a message
        return redirect()
            ->route('login')
            ->with('status', 'Logged out successfully.');
    }
}