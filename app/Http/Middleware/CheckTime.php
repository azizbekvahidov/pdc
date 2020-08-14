<?php

namespace App\Http\Middleware;

use Closure;

class CheckTime
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

        if (!session()->has('groupTime')){
            $time = \App\Groups::find($request->id)->time;
            session(['groupTime' => $time]);
        }
        if (session()->get('groupTime') > time()){
            return $next($request);
        }
        else{
            return redirect()->route('frontend.profile.index')->with(['message' => 'Время окончилось']);
        }
    }
}
