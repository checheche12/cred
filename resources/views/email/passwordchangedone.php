<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

$token = base64_decode($_POST['token2']);
if($_POST['token']!=$token){
    echo "올바른 접근이 아닙니다.";
    echo "3초뒤에 메인 화면으로 이동합니다./n";
    echo "<script type='text/javascript'>setTimeout(function(){
      document.location.href='./';
    },3000);</script>";
    exit;
}

class changeAuthClass extends Controller
{
    public function changeAuth()
    {
        $email = base64_decode(base64_decode(base64_decode($_POST['email'])));
        for($i = 0; $i < $_POST['token']%7; $i++){
          $email = base64_decode((base64_decode($email)));
        }
        $PasswordLockss = DB::select(DB::raw('select PASSWORD("'.$_POST['PW'].'")'));
        foreach($PasswordLockss as $PasswordLocks){
          foreach($PasswordLocks as $PasswordLock){
            $GLOBALS['pLock'] = $PasswordLock;
          }
        }
        $fix = DB::update("update userinfo set Password = ? where Email = ?", [$GLOBALS['pLock'],$email]);
        echo "변경이 완료되었습니다. 이제 이 비밀번호로 접속하실 수 있습니다.";
        echo "3초뒤에 메인 화면으로 이동합니다./n";
        echo "<script type='text/javascript'>setTimeout(function(){
          document.location.href='./';
        },3000);</script>";
    }


}

$A = new changeAuthClass();
$A->changeAuth();

?>
