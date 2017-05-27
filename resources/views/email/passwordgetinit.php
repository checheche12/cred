<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

$string = base64_decode($_GET['aabbcc']);
$string = base64_decode($string);
$strings = explode('|',$string);
$userPK = base64_decode($strings[0]);
$DateTime = base64_decode($strings[2]);
$Email = base64_decode($strings[1]);
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

?>

<form id = "form" method="post" action = "passwordchangedone">

  <p class="labels">변경하실 패스워드</p>
  <input class = "BOX" id = "PWPW" name ="PW" type="password"><br><br>

  <input type='hidden' name="token2" id = "info" value = <?=$_GET['aabbcc']?>>

    <!-- Testing Button-->
    <!-- <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false" onlogin="loginProcess()" scope="public_profile,email"></div> -->

    <input id = "subsub" type="submit" value="확인" />

</form>
