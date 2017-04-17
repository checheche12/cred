<?php

?>
<!-- FOUC(Flash Of Unstyled Content) 방지 용 head-->
<head>
  <link href=“https://fonts.googleapis.com/css?family=Montserrat|Roboto” rel=“stylesheet” type="text/css">
  <style type="text/css">
    .noJs {display: none;}
    /*#pfpf{display: none;}*/
    /*#header{display: none;}*/
  </style>
  <script type="text/javascript">
    document.documentElement.className = 'noJs';
  </script>
  <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
</head>

<!-- Facebook API -->
<script>


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
  };

  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" type ="text/css" href="css/main.css?v=1">

<div id ='header'>
  <?php
        include_once('../resources/views/header.php');
   ?>
</div>
    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
      -->
      <div id = "pfpf" class = "ProfileBasicInfo">
        <?php
              include_once('../resources/views/ProfileBasicInfo.php');
         ?>
      </div>

      <div id = "profileContent">
        <div id = "profileSelection">
          <ul>
            <li id = "Project">프로젝트</li>
            <li id = "Bridge">크레딧 공유자</li>
            <?php
            if($_SESSION['isGroup']=="Group"){
              echo "<li id = 'Members'>멤버</li>";
            }
            ?>
          </ul>
        </div>
        <div id = "profileBody">
          <div id = "memberAddFrame">
            <input id="memberSearch" type="text" name="name" placeholder="Search Member">
            <input id="hiddenSearchValue" type="hidden" name="hiddenSearchValue">
            <button id="addMember">추가</button>
          </div>
          <div id = "projectLayout"></div>  <!-- css 가 다루기 힘들어서 ProfileBody를 레이아웃들로 나눔-->
          <div id = "bridgeLayout"></div>
        </div>
      </div>

      <?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
?>
<script>
  var userPK = <?=$_SESSION['userPK']?>;
</script>
<script type = "text/javascript" src = "js/main.js"></script>
<script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
  $(function(){
    $('.noJs').css('display','block');
  });
</script>
