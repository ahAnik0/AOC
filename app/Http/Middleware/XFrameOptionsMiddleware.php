<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class XFrameOptionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Add the X-Frame-Options header to the response
        $response->header('X-Frame-Options', 'DENY');

        return $response;
    }
}
