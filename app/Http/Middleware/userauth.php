<?php

namespace App\Http\Middleware;

use Closure;

class userauth
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
        if($_SESSION['is_login']==true){
            return $next($request);
        }
        return redirect("/");
    }
}
