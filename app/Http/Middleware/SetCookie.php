<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetCookie
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
        $value  = substr($request->getPathInfo(), -1);
        if(session()->has('start')){
            return $next($request);
        }
        else{
            return redirect()->route('frontend.test.start',$value);
        }
    }
}
