<link rel="stylesheet" type ="text/css" href="css/firstLogin.blade.css">


<?php
    session_start();
    if(isset($_SESSION['is_login'])){
      header('Location: ./main');
      exit;
    }
?>

<div class="logo">
  <img src = "/mainImage/signupImage/signupLogo.png" width="187px"><br>
</div>
<div class="quote">CRED. New experience!</div>
<form method="post" action = "auth">
<div class="infoFrame">
  <p>이메일</p>
  <input class = "BOX" id = "IDID" name = "ID" type="text"><br>
  <p>패스워드</p>
  <input class = "BOX" id = "PWPW" name ="PW" type="password"><br><br>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="buttons">

<!--   <input id = "subsub" type="submit" value = "Log in"> -->
  <input id = "subsub" type="image" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-9/16711893_10155812420853135_566586362708508326_n.jpg?oh=55c618a83e48473dde87d13f28dd0ef9&oe=5902573D"/>
<!-- <a id = "signUp" href=""href = "naver.com">회원가입</a> -->

</form>

<a href = "/signup"><img src = "https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-9/16708416_10155812438113135_2115653503167242082_n.jpg?oh=e80878a5317abb2d7537de52cd5118d6&oe=59391D2F"></a>

</div>

<?php

?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
