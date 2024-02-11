<?php

namespace App\Http\Middleware;

use Closure;

class DisableTraceMethod
{
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'TRACE') {
            return response()->json(['error' => 'TRACE method not allowed.'], 403);
        }

        return $next($request);
    }
}

