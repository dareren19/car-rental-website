<?php
// app/Http/Middleware/RedirectIfAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            // If admin tries to access any non-admin route, redirect to admin dashboard
            return redirect()->route('admin.layouts.dashboard');
        }

        return $next($request);
    }
}