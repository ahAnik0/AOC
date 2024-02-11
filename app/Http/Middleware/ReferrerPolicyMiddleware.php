<?php

namespace App\Http\Middleware;

use Closure;

class ReferrerPolicyMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Referrer-Policy', 'strict-origin');
        return $response;
    }
}
