<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/user/payViaAjax', '/member/sslcommerz/success', '/member/sslcommerz/cancel', '/member/sslcommerz/fail', '/member/sslcommerz/ipn', '/tappayment', '/movie_payment', '/upload_log', '/uploadEmpList', '/syncid', '/UpdateStatus', '/api/*'
    ];

    protected $addHttpCookie = false;
}
