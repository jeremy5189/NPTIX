<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
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
        if ( Session::get('login') != 'yes' ) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/admin/login');
            }
        }

        return $next($request);
    }
}
