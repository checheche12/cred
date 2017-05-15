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

        $GLOBALS['notification'] = DB::select("select A.notificationPK ,A.notificationKind,B.eventCheck, B.userPK,B.ProfilePhotoURL,
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style type="text/css">
    .headerFrame{
      display: none;
    }
  </style>

</head>
<link rel="stylesheet" type ="text/css" href="css/header.css?v=1">
<div class="headerFrame">
  <div id = "header">
    <img id = "credImage" src = "mainImage/signupImage/signupLogo.png" title="홈페이지">

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 1)
      -->
      <form id="searchbar" <?php if($_SESSION['is_login'] == false){echo'style="display:none"';}?>>
        <div id="searchDropdown">
          <input id="searchSlot" class="searchSlot" type="text" name="search" placeholder="Search.." >
          <br>
          <div id="searchDropdown_content">
          </div>

        </div>
        <input type="button" name="submitbutton" id="searchButton">
      </form>
      <div class="headIcons">
        <?php
        if($_SESSION['is_login'] == true){
          echo '<div id = "profile">';
          echo '<img id = "profileImage" src = '.$GLOBALS['photoURL'].' title="나의 프로필">';
          echo '<p id = "profileName" title="나의 프로필">'.$GLOBALS['name'].'</p>';
          echo '</div>';
        }
        if($_SESSION['is_login'] == false){
          echo '<button id = "login" class="dropdowns">로그인</button><br>';

        }else{

          // <button id = "yourart" class="icons"></button>
          echo '<div id="buttons">
          <button id = "dm" class="icons" title = "DM"></button>
          <button id = "notification" class = "icons_none" title="알림"</button>
            <button id = "upload" class="icons" title="업로드"></button>
            <button id = "logout" class="icons" title="로그아웃"></button>
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
            </div>';
          }
        //  \App\Http\Middleware\notiSendFunction::notiMake_Place();
        //  \App\Http\Middleware\notiSendFunction::notiMake_noPlace();
          ?>

        </div>
      </div>
    </div>

    <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type = "text/javascript" src = "js/header.js"></script>
