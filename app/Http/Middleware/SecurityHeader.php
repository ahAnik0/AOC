<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeader
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        // $response->headers->set('Content-Security-Policy', "default-src 'self' fonts.gstatic.com style-src fonts.gstatic.com fonts.googleapis.com 'self' 'unsafe-inline' https://tilbd.xyz/* frame-ancestors 'self' frame-src https://www.google.com https://www.youtube.com 'self'; script-src 'self' 'nonce-YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z' cdnjs.cloudflare.com code.jquery.com merchant-pg-ui-prod.tadlbd.com unpkg.com https://www.youtube.com 'none' 'unsafe-inline' object-src; base-uri 'self' img-src 'self' data:;media-src *");
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // $response->headers->set('Expect-CT', 'enforce, max-age=30');
        $response->headers->set('Permissions-Policy', 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()');
        $response->headers->set('Access-Control-Allow-Origin', 'https://' . $_SERVER['SERVER_NAME']);
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type,Authorization,X-Requested-With,X-CSRF-Token');
        $response->header('X-Powered-By', null);

        return $response;
    }

    /**
     * @param $headers
     */


    private function removeUnwantedHeaders($headers): void
    {
        foreach ($headers as $header) {
            header_remove($header);
        }
    }
}
