<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // if (Auth::guard('admin')->check() && Auth::check()) {
        //     // Jika pengguna sudah masuk dengan guard 'admin', jangan lakukan pengalihan
        //     return null;
        // }

        return $request->expectsJson() ? null : route('root.root-main-index');
    }
}
