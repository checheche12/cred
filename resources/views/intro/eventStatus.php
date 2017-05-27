<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class eventStatusClass extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function eventStatus(){
        	DB::update("update userinfo set eventStatus = eventStatus | 1 where userPK= ?",[$_SESSION['userPK']]);
        }
    }

    $A = new eventStatusClass();
    $A->eventStatus();

    ?>
