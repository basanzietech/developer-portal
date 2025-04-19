<?php
namespace App\Http\Middleware;
use Closure;
use App\Models\Developer;

class CheckApiKey {
    public function handle($request, Closure $next) {
        $key = $request->header('X-API-KEY');
        if (!$key || !($dev = Developer::where('api_key', $key)->first())) {
            return response()->json(['message'=>'Invalid API Key'], 401);
        }
        // attach developer
        $request->merge(['developer' => $dev]);
        return $next($request);
    }
}