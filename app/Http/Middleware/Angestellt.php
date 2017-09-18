<?php

namespace App\Http\Middleware;

use App\Group;
use Closure;

class Angestellt
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
        if($request->user()->group_id != Group::HOTELANGESTELLTER){
            return redirect(route("/"));
        }
        return $next($request);
    }
}
