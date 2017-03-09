<link rel="stylesheet" type ="text/css" href="css/firstLogin.blade.css">


<?php
    session_start();
    if(isset($_SESSION['is_login'])){
      header('Location: ./main');
      exit;
    }
?>

<div class="logo">
  <img src = "/mainImage/signupImage/credlogowhite.png" width="187px"><br>
</div>
<div class="quote">CRED. New experience!</div>
<form id = "form" method="post" action = "auth">
<div class="infoFrame">
  <p class="labels">이메일</p>
  <input class = "BOX" id = "IDID" name = "ID" type="text"><br>
  <p class="labels">패스워드</p>
  <input class = "BOX" id = "PWPW" name ="PW" type="password"><br><br>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="buttons">

<!--   <input id = "subsub" type="submit" value = "Log in"> -->
  <input id = "subsub" type="image" src="/mainImage/login_bt_before_hover.png"/>
<!-- <a id = "signUp" href=""href = "naver.com">회원가입</a> -->

</form>

<a href = "/signup"><img id="signupBt" src = "/mainImage/signup_bt_before_hover.png"></a>

</div>

<?php

?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
