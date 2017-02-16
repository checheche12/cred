<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>

<link rel="stylesheet" type ="text/css" href="css/upload.css">

<div id = "header">
  <img id = "credImage" src = "mainImage/CredLogo.jpg">

  <!--
      아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 1)
  -->

  <?php
      echo '<div id = "profile">';
      echo '<img id = "profileImage" src = "mainImage/profile.jpg">';
      echo '<div id = "profileName">mina</div>';
      echo '</div>';
   ?>
   <button id = "upload">upload</button>
</div>

<p id = "uploadtext" >upload</p>

<div id = "video">

</div>

<div id = "contextBox">

  <p>제목</p>
  <input id = "titleBox" type="text"></input>

  <p>URL</p>
  <input id = "URLBox" type="text"></input>

  <p>크레딧(이메일/직책)</p>
  <input id = "email" type="text"></input>
  <input id = "position" type="text"></input>
  <button id = "submitCredit">크레딧 추가</button><br><br>
  추가된 크레딧
  <div id = "creditBox">

  </div>

  <p>내용</p>
  <textarea id = "context" cols : "40" rows:"10"></textarea><br><br>

  <button id = "submit">등록</button>
  
<div>
