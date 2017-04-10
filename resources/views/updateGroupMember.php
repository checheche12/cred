<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class updateGroupMemberClass extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function updateGroupMember()
      {
        DB::insert('insert into groupMemberDB (groupPK, userPK) values (?, ?)',array($_SESSION['userPK'],$_GET['newMemberUserPK']));
      }
    }

    $A = new updateGroupMemberClass();
    $A->updateGroupMember();

    ?>
