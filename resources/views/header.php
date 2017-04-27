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

        $GLOBALS['notification'] = DB::select("select A.notificationPK ,A.notificationKind,B.userPK,B.ProfilePhotoURL,
          B.Name,C.title,C.artPK, D.Position,A.notificationPlacePK
          from notification as A left join userinfo as B on A.senderuserPK = B.userPK
          left join totalart as C on C.artPK = A.notificationPlacePK
          left join workDB as D on C.artPK = D.artPK and A.recieveruserPK = D.userPK
          where A.recieveruserPK = ? order by notificationPK DESC;",[$_SESSION['userPK']]);
      }

      public static function notification($noti)
      {
        if($noti->notificationKind == "1")
        {
          echo "<a href = '/anotherProfile?int=".$noti->userPK."'>
          <div>
            <img class = 'notiImage' src = '".$noti->ProfilePhotoURL."'></img>
            ".$noti->Name."님이 당신의 채용 공고에 지원하였습니다.
          </div>
        </a>";
      }
      else if($noti->notificationKind == "3")
      {
        echo "<div id = '".$noti->artPK."' notinoti = '".$noti->notificationPK."'>
        <a href = '/post?int=".$noti->artPK."'>
          <div>
            <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
            ".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧 요청을 했습니다. 수락하시겠습니까?
          </div>
        </a>
        <button id = 'yes' class = 'yesbutton'>수락</button>
        <button id = 'no' class = 'nobutton'>취소</button>
      </div>
      ";
    }
    else if($noti->notificationKind == "5")
    {
      echo "<div id = '".$noti->artPK."'>
      <a href = '/post?int=".$noti->artPK."'>
        <div>
          <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
          ".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧을 요청한것을 수락했습니다.
        </div>
      </a>
    </div>
    ";
  }
  else if($noti->notificationKind == "6")
  {
    echo "<div id = '".$noti->artPK."'>
    <a href = '/post?int=".$noti->artPK."'>
      <div>
        <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
        ".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧을 요청한것을 거절했습니다.
      </div>
    </a>
  </div>
  ";
  }else if($noti->notificationKind == "7")
  {
    echo "<div id = '".$noti->userPK."'>
          <a href = '/anotherProfile?int=".$noti->userPK."'>
              <div>
                  ".$noti->Name."님이 Connect 요청했습니다. 클릭하시면 프로필로 이동합니다.
              </div>
          </a>
  </div>";
  }else if($noti->notificationKind == "8")
  {
    echo "<div id = '".$noti->userPK."'>
          <a href = '/anotherProfile?int=".$noti->userPK."'>
              <div>
                  ".$noti->Name."님의 Connect 요청을 수락했습니다.
              </div>
          </a>
  </div>";
  }else if($noti->notificationKind == "9")
  {
    echo "<div id = '".$noti->userPK."'>
          <a href = '/anotherProfile?int=".$noti->userPK."'>
              <div>
                  ".$noti->Name."님이 Connect 요청을 거절했습니다.
              </div>
          </a>
  </div>";
  }



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
      <form id="searchbar" <?php if($_SESSION['is_login'] == false){echo'style="display:none"';}?>>
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
        if($_SESSION['is_login'] == true){
          echo '<div id = "profile">';
          echo '<img id = "profileImage" src = '.$GLOBALS['photoURL'].'>';
          echo '<p id = "profileName">'.$GLOBALS['name'].'</p>';
          echo '</div>';
        }
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
              UserController::notification($noti);
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
