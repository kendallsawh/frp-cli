<?php

namespace App\Http\Middleware\Roles;

use Closure;
use Auth;

class RoleDFO
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
        if(Auth::user()->role_slug == 'dfo'){
            return $next($request);
        }
        return back()->with('flashed', 'Unauthorised to access that page!!');
    }
}
