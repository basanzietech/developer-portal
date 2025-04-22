<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function dashboard(Request $request)
    {
        $dev       = $request->user();
        $userCount = $dev->users()->count();

        return view('dashboard', [
            'apiKey'    => $dev->api_key,
            'userCount' => $userCount,
        ]);
    }

    public function generate(Request $request)
    {
        $dev = $request->user();
        $dev->api_key = \Illuminate\Support\Str::random(32);
        $dev->save();

        return redirect()
            ->route('dashboard')
            ->with('status', 'API Key generated successfully.');
    }
}