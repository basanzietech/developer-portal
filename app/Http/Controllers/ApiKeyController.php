<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function generate(Request $request)
    {
        $user = Auth::user();
        $user->api_key = Str::random(32);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'API Key generated successfully.');
    }
}