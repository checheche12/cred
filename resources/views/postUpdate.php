<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

          DB::insert('insert into workDB (userPK, position, artPK)
            values (?, ?, ?)',array($credit[0],$credit[1],$artNumber));
          DB::insert('insert into artDB (artPK, userPK)
            values (?,?)',array($artNumber,$credit[0]));

        }
      }

      $A = new RunQuery();
      $A->Query();

      ?>
