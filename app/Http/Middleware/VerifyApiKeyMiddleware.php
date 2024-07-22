<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('X-API-KEY') || ($request->header('X-API-KEY') !== env('APP_API_KEY'))) {
            return response()->json("FORBIDDEN", Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
