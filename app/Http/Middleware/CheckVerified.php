<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
// use Symfony\Component\HttpFoundation\Response;

class CheckVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->is_verified == false) {
            // Jika admin belum diverifikasi, alihkan mereka ke halaman tertentu
            return Response::view('base.error.base-error-verify');
        }
    
        return $next($request);
    }
}
