<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //check if the user is logged in and is also logged in as an administrator role
        if(Auth::check() == false)
        {
            //if the user isn't logged in redirect to the main home page.
            return redirect('/');
        }
        else
            if(Auth::user()->$role == false)
            {
                //if the user is logged in but isn't admin redirect to the main page.
                return redirect('/');
            }
        return $next($request);
    }
}
