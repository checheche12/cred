<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

  $token = base64_decode($_GET['to']);
  if($_GET['token']!=$token){
    echo "올바른 접근이 아닙니다.";
    echo "3초뒤에 메인 화면으로 이동합니다./n";
    echo "<script type='text/javascript'>setTimeout(function(){
      document.location.href='./';
    },3000);</script>";
    exit;
  }
?>

<form id = "form" method="post" action = "passwordchangedone">

  <p class="labels">변경하실 패스워드</p>
  <input class = "BOX" id = "PWPW" name ="PW" type="password"><br><br>

  <input type="hidden" name="_token" id ="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="email" id = "email" value = <?=$_GET['email']?>>
  <input type='hidden' name="token" id ="token" value = <?=$_GET['token']?>>
  <input type='hidden' name="token2" id = "token2" value = <?=$_GET['to']?>>

    <!-- Testing Button-->
    <!-- <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false" onlogin="loginProcess()" scope="public_profile,email"></div> -->

    <input id = "subsub" type="submit" value="확인" />

</form>
