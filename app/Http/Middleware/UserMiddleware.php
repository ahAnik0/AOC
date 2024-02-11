<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->uri == "user/movie_set_date/{movie_id}"){
            Session::put('movie',($request->route()->parameters)['movie_id']);
        }
        if (Auth::guard('user')->check()) {
            return $next($request);
        }else{
            return redirect()->route('user.login');
        }
    }
}
