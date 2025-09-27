<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-Token');

        // Token diset manual di .env
        if ($token !== env('API_TOKEN')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid API Token'
            ], 401);
        }

        return $next($request);
    }
}
