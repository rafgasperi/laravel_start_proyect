<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class SentinelGuest
{
    public function handle($request, Closure $next)
    {
        if(Sentinel::check())
        {
            return response()->view('noaccess', [], 403);
        }

        return $next($request);
    }
}