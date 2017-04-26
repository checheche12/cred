<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class anotherProfileAuth extends BaseVerifier
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

          if($_SESSION['userPK']==$_GET['int']){
            return redirect("/main");
          }

          return $next($request);

    }

}
