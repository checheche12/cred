<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConnectApplyClass
{
      /**
        *success 는 친구 추가 신청 성공, already 는 이미 친구 추가가 되어있음을 나타낸다.
        * 상태에서 0은 친구 추가를 발신했고 대기중인 상태
        * 상태에서 1은 친구 추가를 수신했고 대기중인 상태
        * 상태에서 2는 이미 서로 친구인 상태이다..
       */
      public function ConnectApply()
      {
          $selectConnect = DB::select('select * from Connect where connectSenduserPK = ? and connectRecieveruserPK = ?',[$_SESSION['userPK'],$_GET['userPK']]);
          $connectCredit = DB::select('select * from workDB as A left join workDB as B on A.artPK = B.artPK
          where A.userPK = ? and B.userPK = ? and B.checkCredit = 1;',[$_SESSION['userPK'],$_GET['userPK']]);

          if(($selectConnect == null) && ($connectCredit == null)){
            $Connect1 = DB::insert('insert into Connect (connectSenduserPK, connectRecieveruserPK, stats) values (?,?,?)',[$_SESSION['userPK'],$_GET['userPK'],0]);
            $Connect2 = DB::insert('insert into Connect (connectSenduserPK, connectRecieveruserPK, stats) values (?,?,?)',[$_GET['userPK'],$_SESSION['userPK'],1]);
            $notification = DB::insert('insert into notification (senderuserPK, recieveruserPK, notificationKind, uploaddate) values
             (?,?,?,?)',[$_SESSION['userPK'],$_GET['userPK'],"7",date("Y-m-d H:i:s")]);
            echo "success";
          }else{
            echo "already";
          }

      }

}

$A = new ConnectApplyClass();
$A->ConnectApply();

?>
