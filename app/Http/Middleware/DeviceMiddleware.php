<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\deviceIdentifierController;


class DeviceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $identifyUser = new deviceIdentifierController();
        $device = $identifyUser->index();
        if ($device) {
            return $next($request);
        }
        return redirect()->back()->with('error', 'Access denied.');
          // Deny access and redirect
        //   return redirect()->route('home')->with('error', 'Access denied.');
    }
}
