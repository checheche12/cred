<?php

namespace App\Http\Middleware;

use Closure;

class Usercheck
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
        session_start();
        if(!isset($_SESSION['is_login'])){
        	$_SESSION['is_login'] = false;
        	$_SESSION['persongroup'] = "guest";
        	$_SESSION['isGroup'] = "guest";
        	$_SESSION['userPK'] = "0";
        }
        return $next($request);
    }
}
