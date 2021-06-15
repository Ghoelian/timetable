<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HeadersMiddleware
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
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', "default-src https: 'self'; script-src https: 'self'; style-src https: 'self'; img-src https: 'self' data:; font-src https: 'self'; connect-src https: 'self'; media-src https: 'self'; object-src https: 'self'; child-src https: 'self'; frame-src https: 'self'; frame-ancestors https: 'self'; form-action https: 'self'; upgrade-insecure-requests; block-all-mixed-content;");
        $response->headers->set('Permissions-Policy', 'execution-while-not-rendered=(self), execution-while-out-of-viewport=(self), fullscreen=(), sync-xhr=(), geolocation=(), midi=(), microphone=(), camera=(), magnetometer=(), gyroscope=(), payment=()');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0,post-check=0, pre-check=0,no-cache, private');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000');

        return $response;
    }
}
