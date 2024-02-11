<?php

namespace App\Http\Middleware;

use Closure;

class CspMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'nonce-AUTsxz3l762GZd9yRvGzSzvIOiM4UNxR' ; style-src 'self' 'nonce-AUTsxz3l762GZd9yRvGzSzvIOiM4UNxR' 'https://fonts.googleapis.com'; object-src 'none'; frame-ancestors 'self';");

        return $response;
    }
}
