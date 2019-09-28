<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Role;

class Admin
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

        if ( Auth::check() && Auth::user()->hasRole(Role::ROLE_ADMIN))
        {
            return $next($request);
        }

        return redirect()->route('admin.login.get');
    }
}
