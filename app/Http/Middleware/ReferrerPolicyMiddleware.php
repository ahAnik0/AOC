<?php

namespace App\Http\Middleware;

use Closure;

class ReferrerPolicyMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Set the Referrer-Policy header to "no-referrer"
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
