 <?php
 session_start();
 if(!isset($_SESSION['is_login'])){
   header('Location: ./');
   exit;
 }
 ?> 
 <!-- FOUC(Flash Of Unstyled Content) 방지 용 head-->
 <head>
  <link href=“https://fonts.googleapis.com/css?family=Montserrat|Roboto” rel=“stylesheet” type="text/css">
  <link rel="icon" type="image/png" href="mainImage/webicon_16x16.png" sizes="16x16" />
  <link rel="stylesheet" type ="text/css" href="css/forward.css">
  <style type="text/css">.noJs {display: none;}</style>
  <script type="text/javascript">document.documentElement.className = 'noJs';
  </script>
</head>
<body>

  <div id ='header'>
  </div>
  <div id = "pfpf" class = "ProfileBasicInfo"></div>
  <div id = "profileContent">
    <div id = "profileSelection">
      <ul>
        <li id = "Project">Project</li>
        <li id = "Bridge">Bridge</li>
      </ul>
    </div>
    <div id = "profileBody">
      <!--  -->
      <!-- <div id="cardFrame">
        <div id="creatorInfo">
          <img id="creatorPicUrl" src="https://pbs.twimg.com/profile_images/791067045991358464/yy_F__YU.jpg">
          <p id="creatorName">creatorName</p>
          <p id="creatorPosition">creatorPosition</p>
          <p id="passedTime">passedTime</p>
        </div>
        <div id="msgInfo_recieved">
          <div id="msgBorder_recieved">
            <div id="msgContents_recieved">
              <p id="forwardedBy">forwardedBy</p>
              <hr id="infoSplit">
              <p id="msgTitle_recieved">msgTitle</p>
              <hr id="infoSplit">
              <p id="msgDetail_recieved">msgDetail</p>
              <hr id="infoSplit">
              <div id="msgBt_recieved">
                <button id="forwardBt">forward</button>
              </div>
            </div>

          </div>
        </div>
      </div> -->
<!--  -->
    </div>
  </div>
  <div id="writeMsg">
    <!-- <form id="msgSendDB" method="post" action="msgSendDB" > -->
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div id="recieverList">받는사람List</div>
      <hr id="infoSplit">
      <input id="msgTitle_send" name="Title" placeholder="Title: 제목">
      <hr id="infoSplit">
      <textarea id="msgDetail_send" name="Detail" placeholder="Detail: 내용"></textarea>
      <input id="msgExp_send" name="Expire_date" placeholder="Expire: 만료일자">
      <hr id="infoSplit">
      <div id="msgBt_send">
        <input id="sendBt" type="submit" value="submit">
        <input id="cancelBt" type="button" value="Cancel">
      </div>

    <!-- </form> -->

  </div>
</body>
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
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type = "text/javascript" src = "js/forward.js"></script> 
<script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
  $(function(){
    $('.noJs').css('display','block'); 
  });
</script>
