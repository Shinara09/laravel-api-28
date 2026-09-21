<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try{
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return response()->json(['error' => 'Unauthorizedddd'], 401);
        }

        return $next($request);
    }
}
