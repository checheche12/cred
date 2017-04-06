<?php
namespace App\Http\Controllers;
namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


use Closure;

class isgetauth
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
        $Sentence = "select userPK from workDB where artPK = ".$_GET['int'];
        $users = DB::select(DB::raw($Sentence));
        $checkInfo = false;
        foreach($users as $user){
            if($user->userPK == $_SESSION['userPK']){
              $checkInfo = true;
            }
        }
        if($checkInfo==false){
          return redirect("/");
        }

        return $next($request);
    }
}
