<?php

namespace App\Http\Middleware;

use App\Group;
use Closure;

class ManagerOnly
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
        if($request->user()->group_id != Group::HOTELMANAGER){
            return redirect(route("home"));
        }
        return $next($request);
    }
}
