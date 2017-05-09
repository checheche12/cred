<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class requestCreditClass extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function requestCredit()
      {
        DB::insert('insert into workDB (userPK, position, artPK)
          values (?, ?, ?)',array($_SESSION['userPK'],$_GET['position'],$_GET['artPK']));

        $users = DB::select(DB::raw("select uploader from totalart where artPK = ".$_GET['artPK']));
        $GLOBALS['uploader']='';
        foreach($users as $user){
          $GLOBALS['uploader'] = $user->uploader; //이름이 아닌 userPK 값임.
        }

        DB::insert('insert into notification (senderuserPK,recieveruserPK,notificationKind,notificationPlacePK
          ,uploaddate) values (?,?,?,?,?)',[$_SESSION['userPK'],$GLOBALS['uploader'],"2",$_GET['artPK'],date("Y-m-d H:i:s")]);

      }
    }

    $A = new requestCreditClass();
    $A->requestCredit();

    ?>
