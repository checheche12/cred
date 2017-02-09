<?php
    session_start();
    if(isset($_SESSION['is_login'])){
      header('Location: ./main');
      exit;
    }
?>

<form method="post" action = "auth">
  ID: <input name = "ID" type="text"></input><br>
  Password: <input name ="PW" type="password"></input><br>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="submit" value = "Log in"></input>
</form>

<?php

?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
