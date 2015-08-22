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
                return redirect()->route('homeAdmin');
            } elseif (Auth::user()->hasRole('usuario')) {
                return redirect()->route('homeUser');
            }
        }

        return $next($request);
    }
}
