<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function makeNewUser()
      {
        $sameEmail = 0;
        $userNumber = 0;

        $users = DB::select(DB::raw("select * from userinfo where Email = '".$_POST['emailemail']."'" ));
        $sameEmail = empty($users);

            // 비어있다면 실행 안비어 있으면 에러 발생
            //Certification 항목은 본디 0으로 하고 인증 후에 1로 바꿔야하지만 임시로 일단 무조건 1로 생성되게 한다
            //이메일 인증을 구현할때 바꿀 것이다.

        if($sameEmail){
          $PasswordLockss = DB::select(DB::raw('select PASSWORD("'.$_POST['pwpw'].'")'));
          foreach($PasswordLockss as $PasswordLocks){
            foreach($PasswordLocks as $PasswordLock){
              $GLOBALS['pLock'] = $PasswordLock;
            }
          }
          DB::insert('insert into userinfo (Email, Password, Name, Certification) values (?, ?, ?, ?)',[$_POST['emailemail'],$GLOBALS['pLock'],$_POST['namename'],1]);

          /**userExperience Table에 userPK 추가**/
          $Sentence = "select userPK from userinfo where Email = '".$_POST['emailemail']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
          DB::insert('insert into userExperience (userPK) values ('.$GLOBALS['userPK'].')');

        }
        else{
          echo "이미 존재하는 회원 email 입니다.";
        }
        echo "3초뒤에 메인 화면으로 이동합니다./n";
        echo "<script type='text/javascript'>setTimeout(function(){
          document.location.href='./';
        },3000);</script>";
      }
    }
    $Exp = '/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i';
    if(preg_match($Exp,$_POST['emailemail'])==1){
      $A = new UserController();
      $A->makeNewUser();
    }else{
      echo "이메일 형식이 틀렸습니다. 3초뒤 메인화면으로 돌아갑니다./n";
      echo "<script type='text/javascript'>setTimeout(function(){
        document.location.href='./';
      },3000);</script>";
    }
    ?>
