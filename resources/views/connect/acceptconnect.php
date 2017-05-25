<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class acceptConnectClass
{
      /**
        *success 는 친구 추가 신청 성공, already 는 이미 친구 추가가 되어있음을 나타낸다.
        * 상태에서 0은 친구 추가를 발신했고 대기중인 상태
        * 상태에서 1은 친구 추가를 수신했고 대기중인 상태
        * 상태에서 2는 이미 서로 친구인 상태이다..
       */
      public function acceptConnect()
      {
          $select1 = DB::select('select * from Connect where connectSenduserPK = ? and connectRecieveruserPK = ?',
            [$_GET['userPK'],$_SESSION['userPK']]);
          $select2 = DB::select('select * from Connect where connectSenduserPK = ? and connectRecieveruserPK = ?',
            [$_SESSION['userPK'],$_GET['userPK']]);
          foreach($select1 as $abc1){
            $GLOBALS['connectPK1'] = $abc1->connectPK;
            break;
          }
          foreach($select2 as $abc2){
            $GLOBALS['connectPK2'] = $abc2->connectPK;
            break;
          }
          if($select1 != null){
            //값이 있다면 update 해서 값을 2로 바꾼 이후에 받는사람에게 noti 를 쏴줘야한다. 이때는 $_GET['userPK'] 에게 쏴주면 되겠지.
            // 10번은 친구 수락했음을 알려주는것.
            // 8번은 7번에서 수락이 되었음을 알려줌.
            DB::transaction(function(){
              $affected1 = DB::update('update Connect set stats = 2 where connectPK = ?', [$GLOBALS['connectPK1']]);
              $affected2 = DB::update('update Connect set stats = 2 where connectPK = ?', [$GLOBALS['connectPK2']]);
               \App\Http\Middleware\notiSendFunction::notiMake_noPlace($_SESSION['userPK'],$_GET['userPK'],"10");
              $changenoti = DB::update('update notification set notificationKind = 8 where
              senderuserPK = ? and recieveruserPK = ? and notificationKind = 7', [$_GET['userPK'],$_SESSION['userPK']]);
              echo "success";
            });
          }
      }

}

$A = new acceptConnectClass();
$A->acceptConnect();

?>
