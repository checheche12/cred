<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class RunQuery extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function Query()
        {
          $artNumber = $_GET['ArtPK'];
          $credit = $_GET['credit'];

          DB::insert('insert into '.$artNumber.'workDB (userPK, position)
            values (?, ?)',array($credit[0],$credit[1]));
          DB::insert('insert into '.$credit[0].'artDB (artPK)
            values (?)',array($artNumber));

        }
      }

      $A = new RunQuery();
      $A->Query();

      ?>
