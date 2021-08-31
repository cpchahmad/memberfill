<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $has_role = false;
        $roles = \Spatie\Permission\Models\Role::all();
        foreach ($roles as $role){
            if(Auth::user()->hasRole($role)){
                $has_role = true;
            }
        }
        if ($has_role) {
            return $next($request);
        }else{
            Auth::user()->assignRole('merchant');
            return $next($request);
        }

    }
}
