<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Developer;

class CheckApiKey
{
    public function handle($request, Closure $next)
    {
        $key = $request->header('X-API-KEY');
        $dev = Developer::where('api_key', $key)->first();
        if (! $dev) {
            return response()->json(['message'=>'Invalid API Key'], 401);
        }
        $request->merge(['developer' => $dev]);
        return $next($request);
    }
}
