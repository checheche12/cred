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

      <label for="URLBox">URL을 입력하여 프로젝트를 업로드하세요</label><br>
      <input id = "URLBox" type="text" placeholder="동영상 url을 입력해 주세요"></input><br><br>
      <label for="titleBox">제목</label><br>
      <input id = "titleBox" type="text"></input><br><br>

      <label for="email">크레딧</label><br><br>
      <input id = "email" type="text" placeholder=" e-mail"></input>
      <input id = "position" type="text" placeholder=" 담당 역할"></input>
      <button id = "submitCredit" >+추가</button><br><br>
      <!-- 추가된 크레딧 -->

      <div id = "emailsuggest">

      </div>

      <div id = "creditBox">

      </div>

      <label for="context">내용</label><br>
      <textarea id = "context" cols : "40" rows:"10"></textarea><br><br>

      <button id = "cancelButton" class="submitButton">cancel</button>
      <button id = "saveButton" class="submitButton">저장</button>

  </div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/upload.js"></script>
