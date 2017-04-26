<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class denyConnectClass
{
      /**
        *success 는 친구 추가 신청 성공, already 는 이미 친구 추가가 되어있음을 나타낸다.
        * 상태에서 0은 친구 추가를 발신했고 대기중인 상태
        * 상태에서 1은 친구 추가를 수신했고 대기중인 상태
        * 상태에서 2는 이미 서로 친구인 상태이다..
       */
      public function denyConnect()
      {
            $deleteConnect = DB::delete("delete from Connect where connectSenduserPK = ? and connectRecieveruserPK =?",
            [$_SESSION['userPK'],$_GET['userPK']]);
            $deleteConnect = DB::delete("delete from Connect where connectSenduserPK = ? and connectRecieveruserPK =?",
            [$_GET['userPK'],$_SESSION['userPK']]);
      }

}

$A = new denyConnectClass();
$A->denyConnect();

?>
