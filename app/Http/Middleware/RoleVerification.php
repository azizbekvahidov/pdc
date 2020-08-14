<?php

namespace App\Http\Middleware;

use Closure;

class RoleVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(\Auth::user()->role_id == '1' || \Auth::user()->role_id == '2')
            return $next($request);
        else
            return redirect()->route('index');
    }
}
