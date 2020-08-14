<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
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
        $langPrefix = substr($request->route()->getPrefix(),0,2);
        if ($langPrefix) {
            App::setLocale($langPrefix);
        }
        return $next($request);
    }
}
