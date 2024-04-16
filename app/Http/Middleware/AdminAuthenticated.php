<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{

    public function handle(Request $request, Closure $next, $guard = 'admin')
    {

        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::DASHBOARD);
        }
        return $next($request);
    }
}
