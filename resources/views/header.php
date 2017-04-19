<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


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

        $GLOBALS['notification'] = DB::select("select A.notificationKind,B.ProfilePhotoURL,B.Name,C.title from notification as A left join
        userinfo as B on A.senderuserPK = B.userPK
        left join totalart as C on C.artPK = A.notificationPlacePK where A.recieveruserPK = ? order by notificationPK DESC;",[$_SESSION['userPK']]);
      }
    }

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
        <img id = "credImage" src = "mainImage/signupImage/signupLogo.png">

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 1)
      -->
      <form id="searchbar">
        <div id="searchDropdown">
          <input id="searchSlot" class="searchSlot" type="text" name="search" placeholder="Search.." >
          <br>
          <div id="searchDropdown_content">
          </div>

        </div>
        <input type="button" name="submitbutton" value="검색" id="searchButton">
      </form>
      <div class="headIcons">
        <?php
        echo '<div id = "profile">';
        echo '<img id = "profileImage" src = '.$GLOBALS['photoURL'].'>';
        echo '<p id = "profileName">'.$GLOBALS['name'].'</p>';
        echo '</div>';

        if($_SESSION['is_login'] == false){
          echo '<button id = "login" class="dropdowns">로그인</button><br>';

        }else{

          // <button id = "yourart" class="icons"></button>
          echo '<div id="buttons">
          <button id = "notification" class = "icons_none"></button>
          <button id = "upload" class="icons"></button>
          <button id = "logout" class="icons"></button>
          <div id = "notification_out" class = "notification_out_none">';
          foreach($GLOBALS['notification'] as $noti){
              echo "<div>";
              echo "<img class = 'notiImage' src = ".$noti->ProfilePhotoURL."></img>";
              if($noti->notificationKind == "1"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }else if($noti->notificationKind == "2"){
                echo $noti->Name."님이 ".$noti->title." 작품을 변경했습니다.";
              }else if($noti->notificationKind == "3"){
                echo $noti->Name."님으로부터 작품 크레딧 추가에 대한 알림이 와있습니다.";
                echo "<button id = 'yes' class = 'button'>수락</button>";
                echo "<button id = 'no' class = 'button'>취소</button>";
              }else if($noti->notificationKind == "4"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }else if($noti->notificationKind == "5"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }else if($noti->notificationKind == "6"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }else if($noti->notificationKind == "7"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }else if($noti->notificationKind == "8"){
                echo $noti->Name."님으로부터 알림이 와있습니다.";
              }
              echo "</div>";
          }
          echo '</div>
        </div>';

      }
      ?>

    </div>
  </div>
</div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type = "text/javascript" src = "js/header.js"></script>
  <script type="text/javascript"> //FOUC(Flash Of Unstyled Content) 방지 용
    $(function(){
      $('img').on('error',function(){
        $(this).attr('src', '/mainImage/noimage.png');
      });
      $('.headerFrame').css('display','block');
    });
  </script>
