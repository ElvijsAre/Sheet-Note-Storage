<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request and checks if user is admin, if not user is rederected to home.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->is_admin == 1)
        {
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
