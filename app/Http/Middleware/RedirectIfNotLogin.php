<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!Auth::user()->isSuperAdmin() || !Auth::user()->isAdmin() || !Auth::user()->isBHW()) {
                return response()->view('errors.no-access', [], 403);
            } else {
                return response()->view('errors.no-access', [], 403);
            }
        }
        return $next($request);
    }
}
