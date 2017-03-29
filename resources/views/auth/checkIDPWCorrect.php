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

            self::personal();

              try{
                if(!isset($GLOBALS['IDCheck'])){
                  echo "Login Error!";
                  header('Location: ./');
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
                    // Authentication passed...
                    $_SESSION['is_login'] = true;
                    $_SESSION['persongroup'] = "person";
                    $_SESSION['userPK'] = $pkpk;

                    if($GLOBALS['isGroup']=="0"){
                      $_SESSION['isGroup'] = "Person";
                    }else{
                      $_SESSION['isGroup'] = "Group";
                    }

                    header('Location: ./main');
                    exit;
                }else{
                    header('Location: ./');
                    echo "id 혹은 비밀번호가 틀렸습니다. 3초뒤에 메인화면으로 돌아갑니다.";
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

      public function personal()
      {
          try{
            $users = DB::select(DB::raw("select Email, Password, userPK, isgroup from userinfo where Email = "."'".$_POST['ID']."'"));

            foreach ($users as $user) {
                $GLOBALS['IDCheck'] = $user->Email;
                $GLOBALS['PasswordCheck'] = $user->Password;
                $GLOBALS['UserPK'] = $user->userPK;
                $GLOBALS['isGroup'] = $user->isgroup;
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
