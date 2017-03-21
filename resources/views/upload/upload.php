<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}
?>
<script type="text/javascript">
  console.log("check point 1");
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      FB.api( //친구리스트 불러오기
        "/me/taggable_friends?limit=2000",
        function (response) {
          if (response && !response.error) {
            /* handle the result */
            console.log(response)
            for(var i=0; i<response.data.length; i++){
              var data = response.data;
              var edge = response.edge;
              console.log(data[i].name + "number of friend: "+i);
              console.log(data[i].picture.data.url);

            }
          }
        }
        );
    }else {
      // The person is not logged into your app or we are unable to tell.
      // document.getElementById('status').innerHTML = 'Please log ' +
      // 'into this app.';
      console.log('please log into this app');
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '278220249266484',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
    checkLoginState();
  };

  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


</script>

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
