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
        $memberExist = DB::select('select userPK from groupMemberDB where userPK="'.$_GET['MemberUserPK'].'"');
        if($_GET['updateType']=="add"){
          if(count($memberExist)=='0'){
            DB::insert('insert into groupMemberDB (groupPK, userPK) values (?, ?)',array($_SESSION['userPK'],$_GET['MemberUserPK']));
            echo "맴버 추가 성공";
            \App\Http\Middleware\notiSendFunction::notiMake_Place($_SESSION['userPK'],$_GET['MemberUserPK'],"10",$_SESSION['userPK']);
          }else{
            echo "맴버 추가 실패: 맴버가 이미 그룹에 추가되어 있습니다.";
          }
        }else if($_GET['updateType']=="delete"){
          if(count($memberExist)!='0'){
            DB::delete("delete from groupMemberDB where userPK = ?",[$_GET['MemberUserPK']]);
            echo "맴버 삭제 성공";
            \App\Http\Middleware\notiSendFunction::notiMake_Place($_SESSION['userPK'],$_GET['MemberUserPK'],"11",$_SESSION['userPK']);
          }else{
            echo "맴버 삭제 실패: 맴버가 그룹에 존재하지 않습니다.";
          }
        }
      }
    }

    $A = new updateGroupMemberClass();
    $A->updateGroupMember();

    ?>
