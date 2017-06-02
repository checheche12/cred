<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
//use App\Http\Middleware\notiSendFunction as notiSendFunction;

class UserController extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function index()
      {
      	$Sentence = "select * from userinfo where userPK = ".$_SESSION['userPK'];
      	$users = DB::select(DB::raw($Sentence));
      	$GLOBALS['name'] = "GUEST";
      	if(($_SESSION['persongroup'] == "administrator") && ($_SESSION['isGroup'] == "administrator")){
      		$GLOBALS['name'] = "Administrator";
      	}
      	$GLOBALS['photoURL'] = "mainImage/default_profile_pic.png";

      	foreach($users as $user){
      		$GLOBALS['name'] = $user->Name;
      		$GLOBALS['photoURL'] = $user->ProfilePhotoURL;
      	}

      	$eventChecks = DB::select("select eventCheck,msgCheck from userinfo where userPK = ?",[$_SESSION['userPK']]);
      	$GLOBALS['msgCheck']=0;
      	$GLOBALS['eventCheck']=0;
      	foreach($eventChecks as $eventCheck){
      		$GLOBALS['eventCheck'] = $eventCheck->eventCheck;
      		$GLOBALS['msgCheck']=$eventCheck->msgCheck;
      	}

      	$GLOBALS['notification'] = DB::select("select A.checknotification, A.notificationPK ,A.notificationKind, B.userPK,B.ProfilePhotoURL,
      		B.Name,C.title,C.artPK, D.Position,A.notificationPlacePK
      		from notification as A left join userinfo as B on A.senderuserPK = B.userPK
      		left join totalart as C on C.artPK = A.notificationPlacePK
      		left join workDB as D on C.artPK = D.artPK and A.recieveruserPK = D.userPK
      		where A.recieveruserPK = ? order by notificationPK DESC limit ?, 15;",[$_SESSION['userPK'],0]);
      }

    }
    include_once('../resources/views/noti/notifunction.php');
    $A = new UserController();
    $A->index();

    ?>


    <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <!-- css -->
     <link href="css/headerPlus.css" rel="stylesheet" />
     <!-- <link href="css/headerBootstrap.min.css" rel="stylesheet" />
     <link href="css/headerStyle.css" rel="stylesheet" />
     <link rel="stylesheet" type ="text/css" href="css/header.css">
 -->
     <!-- Theme skin -->
     <!-- <link href="css/skins/default.css" rel="stylesheet" /> -->

     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

    </head>
    <body>
     <header>
      <div class="navbar navbar-default navbar-static-top">
       <div class="container">
        <div class="navbar-header">
         <?php 
         if($_SESSION['is_login'] == true){
          echo'<button id="navdrawer" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>';
      } 
      ?>
      <a class="navbar-brand" href="./">Credberry<span>*</span></a>
      <a class="navbar-brand-icon" href="./"><img src="mainImage/credberrylogo.png"></a>
      <form id="searchbar" <?php if($_SESSION['is_login'] == false){echo'style="display:none"';}?> >
       <div id="searchDropdown">
        <input id="searchSlot" class="searchSlot" type="text" name="search" placeholder="Search.." >
        <br>
        <div id="searchDropdown_content"></div>

      </div>
      <input type="button" name="submitbutton" id="searchButton">
    </form>
  </div>
  <?php
  if($_SESSION['is_login'] == false){
    echo'
    <ul class="nav navbar-nav loggedOff">
     <li><a href="./login">로그인</a></li>
   </ul>
   ';
 }else{
  echo'
  <div class="navbar-collapse collapse ">
   <ul class="nav navbar-nav">
    <li><a id = "jobBoardBt">JobBoard</a></li>
    <li><a href="./main">프로필</a></li>';

  						// 알림 설정
    echo'<li class="dropdown">
    <a id="notification" href="#" class="icons_none">알림 ';
      if($GLOBALS['eventCheck']==0){
      }
      else if($GLOBALS['eventCheck']<=9){
        echo "<img id = 'notiSmallImage' class = 'smallImage' src ='/mainImage/notiLogo/noti".$GLOBALS['eventCheck'].".png'></img>";
      }else{
        echo "<img id = 'notiSmallImage' class = 'smallImage 'src ='/mainImage/notiLogo/noti9p.png'></img>";
      }
                //  <!-- <ul class="dropdown-menu">
                //  <li><a href="typography.html">Typography</a></li>
                //  <li><a href="components.html">Components</a></li>
                //  <li><a href="pricingbox.html">Pri cing box</a></li>
                // </ul> -->
      echo'</a>
    </li>
    <li><a href="./dm">메세지';
      if($GLOBALS["msgCheck"]==0){
        echo '';
      }
      else if($GLOBALS["msgCheck"]<=9){
        echo '<img id = "notiSmallImage" class = "smallImage" src ="/mainImage/notiLogo/noti'.$GLOBALS["msgCheck"].'.png"></img>';
      }else{
        echo '<img id = "notiSmallImage" class = "smallImage" src ="/mainImage/notiLogo/noti9p.png"></img>';
      }
      echo'</a></li>';

      echo'<li><a href="./upload">업로드</a></li>
      <li><a href="./bugReport">버그신고</a></li>
      <li><a href="./Logout">로그아웃</a></li>

      <div id = "notification_out" class = "notification_out_none">
        <p id="notiText">알림</p>
        <div id = "notiBox">
         ';
         foreach($GLOBALS['notification'] as $noti){
          $notifunctionClass->notification($noti);
        }
        echo '</div>
        <div id = "addMore">더보기</div>
      </div>
    </div>
  </ul>
</div>
';
}

?>
</div>
</div>
</header>
<!-- javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- <script src="js/jquery.js"></script> -->
	<!-- <script src="js/jquery.easing.1.3.js"></script> -->
	<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type = "text/javascript" src = "js/header.js"></script>
	<!-- <script src="js/headerBootstrap.min.js"></script> -->
<!-- <script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script> -->
</body>
</html>