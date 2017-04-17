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

      //관리자 로그인
            if($_POST['ID']=="administrator"){
              if($_POST['PW']=="credAdministrator1234567890!@#$%^&*()credAdministrator"){
                  $_SESSION['is_login'] = true;
                  $_SESSION['persongroup'] = "administrator";
                  $_SESSION['isGroup'] = "administrator";
                  $_SESSION['userPK'] = "-1";
                  header('Location: ./administrator');
                  exit;
              }
            }
            self::personal();

              try{
                if(!isset($GLOBALS['IDCheck'])){
                  echo "Login Error!";
                  header('Location: ./login');
                  exit;
                }
                $idid = $GLOBALS['IDCheck'];
                $pwpw = $GLOBALS['PasswordCheck'];
                $pkpk = $GLOBALS['UserPK'];
                $PasswordLockss = DB::select(DB::raw('select PASSWORD("'.$_POST['PW'].'")'));
                foreach($PasswordLockss as $PasswordLocks){
                  foreach($PasswordLocks as $PasswordLock){
                    $GLOBALS['pLock'] = $PasswordLock;
                  }
                }

                if(($_POST['ID']==$idid)&&($PasswordLock==$pwpw)) {
                    if($GLOBALS['Certification']=="0"){
                        echo "인증되지 않은 이메일입니다. 인증 이후에 사용해주세요.";
                        echo "3초뒤에 로그인화면으로 돌아갑니다.";
                        echo "<script type='text/javascript'>setTimeout(function(){
                            document.location.href='./login';
                        },3000);</script>";
                    }else{

                    // Authentication passed...
                    $_SESSION['is_login'] = true;
                    $_SESSION['persongroup'] = "person";
                    $_SESSION['userPK'] = $pkpk;

                    if($GLOBALS['isGroup']=="0"){
                      $_SESSION['isGroup'] = "Person";
                    }else{
                      $_SESSION['isGroup'] = "Group";
                    }

                    header('Location: ./');
                    exit;
                  }
                }else{
                    header('Location: ./');
                    echo "id 혹은 비밀번호가 틀렸습니다. 3초뒤에 로그인화면으로 돌아갑니다.";
                    echo "<script type='text/javascript'>setTimeout(function(){
                        document.location.href='./login';
                    },3000);</script>";
                }
              }catch(Exception $e){
                echo "Login Error!";
                header('Location: ./login');
                exit;
              }

    }

    //유저 이메일로 비밀번호와 PK 값을 가지고 와서 전역 변수에 저장해놓는다.

      public function personal()
      {
          try{
            $users = DB::select(DB::raw("select Email, Password, userPK, isgroup, Certification from userinfo where Email = "."'".$_POST['ID']."'"));

            foreach ($users as $user) {
                $GLOBALS['IDCheck'] = $user->Email;
                $GLOBALS['PasswordCheck'] = $user->Password;
                $GLOBALS['UserPK'] = $user->userPK;
                $GLOBALS['isGroup'] = $user->isgroup;
                $GLOBALS['Certification'] = $user->Certification;
            }

          }catch(Exception $e){
            echo "Login Error!";
            header('Location: ./');
            exit;
          }
      }

}

$A = new LoginController();
$A->authenticate();

?>
