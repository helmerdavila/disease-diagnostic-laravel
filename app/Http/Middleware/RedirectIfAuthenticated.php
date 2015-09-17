<?php

namespace Tesis\Http\Middleware;

use Auth;
use Closure;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin::home');
            } elseif (Auth::user()->hasRole('usuario')) {
                return redirect()->route('user::home');
            }
        }

        return $next($request);
    }
}
