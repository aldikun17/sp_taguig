<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class SenderMiddleware
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
        $response = $next($request);

        if(Auth::check())
        {

            if(Auth::user()->user_level != 3)
            {

            }


        }   else {

            return redirect('/')->with('error_login','You must Login First');

        }

        return $response;
    }
}
