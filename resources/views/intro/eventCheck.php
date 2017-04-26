<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class eventCheckClass extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function eventCheck(){
        	DB::update(DB::raw("update userinfo set eventCheck=1 where userPK=".$_SESSION['userPK']));
        }
    }

    $A = new eventCheckClass();
    $A->eventCheck();

    ?>