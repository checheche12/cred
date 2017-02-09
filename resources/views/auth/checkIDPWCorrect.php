<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$IDCheck = 'NotAvaliableAvalible';
$PasswordCheck = 'NotAvaliableAvalible';
$UserPK = 'NotAvaliableAvalible';

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
      // 전역변수로 저장한 ID와 PW 와 userPK 를 분석하여
      //같으면 로그인 인증을 발급하고 틀리면 꺼지게 한다.

        self::index();
        try{
          if(!isset($GLOBALS['IDCheck'])){
            echo "Login Error!";
            header('Location: ./');
            exit;
          }
          $idid = $GLOBALS['IDCheck'];
          $pwpw = $GLOBALS['PasswordCheck'];
          $pkpk = $GLOBALS['UserPK'];
          if(($_POST['ID']==$idid)&&($_POST['PW']==$pwpw)) {
              // Authentication passed...
              $_SESSION['is_login'] = true;
              $_SESSION['userPK'] = $pkpk;
              header('Location: ./main');
              exit;
          }else{
              header('Location: ./');
              echo "당신이 친 값인 id : ".$_POST['ID']."  password : ".$_POST['PW']."은 비밀번호가
              틀렸습니다.";
              echo "<script type='text/javascript'>setTimeout(function(){
                  document.location.href='./';
              },3000);</script>";
          }
        }catch(Exception $e){
          echo "Login Error!";
          header('Location: ./');
          exit;
        }
    }

    //유저 이메일로 비밀번호와 PK 값을 가지고 와서 전역 변수에 저장해놓는다.

      public function index()
      {
          try{
            $users = DB::select(DB::raw("select * from userinfo where Email = "."'".$_POST['ID']."'"));

            foreach ($users as $user) {
                $GLOBALS['IDCheck'] = $user->Email;
                $GLOBALS['PasswordCheck'] = $user->Password;
                $GLOBALS['UserPK'] = $user->userPK;
            }

          }catch(Exception $e){
            echo "Login Error!";
            header('Location: ./');
            exit;
          }
      }

}


session_start();
$A = new LoginController();
$A->authenticate();

?>
