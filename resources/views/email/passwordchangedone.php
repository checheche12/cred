<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class changeAuthClass extends Controller
{
    public function changeAuth()
    {
        $PasswordLockss = DB::select(DB::raw('select PASSWORD("'.$_POST['PW'].'")'));
        foreach($PasswordLockss as $PasswordLocks){
          foreach($PasswordLocks as $PasswordLock){
            $GLOBALS['pLock'] = $PasswordLock;
          }
        }
        DB::transaction(function(){
          $fix = DB::update("update userinfo set Password = ? where Email = ?", [$GLOBALS['pLock'],$GLOBALS['email']]);
          DB::delete('delete from userAuth where userPK = ?',[$GLOBALS['userPK']]);
        });
        echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
        <body>
        <div id="signUpGuideFrame">
        <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
        <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
        <p class="signUpGuideP">변경이 완료되었습니다 이제 이 비밀번호로 접속하실수 있습니다.</p><br>
        </div></body>';
        echo "<script type='text/javascript'>setTimeout(function(){
          document.location.href='./';
        },3000);</script>";
        exit;
    }


}

$string = base64_decode($_POST['token2']);
$string = base64_decode($string);
$strings = explode('|',$string);
$userPK = base64_decode($strings[0]);
$GLOBALS['userPK'] = base64_decode($strings[0]);
$DateTime = base64_decode($strings[2]);
$Email = base64_decode($strings[1]);
$GLOBALS['email'] = base64_decode($strings[1]);
$Date = DB::select('select AuthDate from userAuth where userPK = ?',[$userPK]);
if(empty($Date)||($DateTime != $Date[0]->AuthDate))//잘못된 인증 경로라면
{
  echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
  <body>
  <div id="signUpGuideFrame">
  <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
  <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
  <p class="signUpGuideP">이미 인증이 된 경로이거나 잘못된 경로입니다.</p><br>
  </div></body>';
  echo "<script type='text/javascript'>setTimeout(function(){
    document.location.href='./';
  },3000);</script>";
  exit;
}
else
{
    $A = new changeAuthClass();
    $A->changeAuth();
}

?>
