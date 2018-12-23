<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() == null){
            return response("You don't have right to access this area!",401);
        }
        $actions=$request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        // dd($actions);
        if($request->user()->hasAnyRole($roles) || !$roles)
        {
            return $next($request);
        }
        return response("You don't have right to access this area!",401);
    }
}
