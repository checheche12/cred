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
  <link rel="stylesheet" type ="text/css" href="css/dm.css?v=1">
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

    <div id ='header'>
      <?php
            include_once('../resources/views/header.php');
       ?>
    </div>

    <div id = 'contents'>
        <div id = 'DMTotalList'>
          <?php
              // $GLOBALS['who'] = $_GET['userPK'];
              if(!isset($_GET['userPK'])){
                    $_GET['userPK'] = 0;
              }
              include_once('../resources/views/dm/dmtotalList.php');
              $DMTotalListClass = new DMTotalListClass();
              $DMTotalListClass->DMTotalList($_GET['userPK']);
          ?>
        </div>

        <div id = 'DMoneDetail'>

            <div id = 'DMDetail'>
              <?php
                  if(!isset($_GET['userPK'])){
                    $_GET['userPK'] = $_SESSION['userPK'];
                  }
                  include_once('../resources/views/dm/dmoneDetail.php');
                  $CalloneDetail = new dmoneDetailClass();
                  $CalloneDetail->dmoneDetail($_GET['userPK'],0);
              ?>
            </div>

            <div id = 'DMSend'>
                <textarea id = 'DMText' placeholder="메시지 입력 ..."></textarea>
                <button id = 'send'>전송</textarea>
            </div>

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
  var recieveruserPK = <?=$_GET['userPK']?>
</script>
<script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
  $(function(){
    $('.noJs').css('display','block');
  });
</script>
<script type = "text/javascript" src = "js/dm.js"></script>
