<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>

<link rel="stylesheet" type ="text/css" href="css/upload.css">

<div id = "header">

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


<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/upload.js"></script>
