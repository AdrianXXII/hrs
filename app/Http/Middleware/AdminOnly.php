<?php

namespace App\Http\Middleware;

use App\Group;
use Closure;

class AdminOnly
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
        if($request->user()->group_id != Group::ADMINISTRATOR){
            return redirect(route("home"));
        }
        return $next($request);
    }
}
