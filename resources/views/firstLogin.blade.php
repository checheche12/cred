<link rel="stylesheet" type ="text/css" href="css/firstLogin.blade.css">


<?php
    session_start();
    if(isset($_SESSION['is_login'])){
      header('Location: ./main');
      exit;
    }
?>

  <img src = "mainImage/LoginMain1.png"><br>
  <img src = "mainImage/LoginEmail.png">
<form method="post" action = "auth">
  <input class = "BOX" id = "IDID" name = "ID" type="text"></input><br>
  <img src = "mainImage/LoginPass.png"><br>
  <input class = "BOX" id = "PWPW" name ="PW" type="password"></input><br><br>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input id = "subsub" type="submit" value = "Log in"></input>
  <a id = "signUp" href=""href = "naver.com">회원가입</a>
</form>



<?php

?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
