<?php

namespace Tesis\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;

class soloPaciente
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->auth->check()) {
            return abort(401);
        }

        if ($this->auth->user()->hasRole('admin')) {
            return abort(404);
        }

        return $next($request);
    }
}
