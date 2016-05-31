<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class BlockedMiddleware
{
    /**
     * Handle an incoming request and checks if user is blocked, if true user is rederected to home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->is_blocked == 0)
        {
            return $next($request);
        }

        Session::flash('failed', 'This account has been blocked, contact a admin!');
        return redirect()->guest('/');
    }
}
