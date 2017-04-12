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
          <input id="searchSlot" class="searchSlot" type="text" name="search" placeholder="Search..">
          <br>
          <div id="searchDropdown_content">
          </div>

        </div>
        <input type="submit" name="submitbutton" value="검색" id="searchButton">
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

          echo '<div id="buttons">
          <button id = "yourart" class="icons"></button>
          <button id = "upload" class="icons"></button>
          <button id = "logout" class="icons"></button>
        </div>';
      //   echo '<div class="dropdown">
      //   <button class="dropbtn">메뉴</button>
      //   <div class="dropdown-content">
      //     <button id = "yourart" class="dropdowns"><div id="yourartBtSp">yourArt</div></button><br>
      //     <button id = "upload" class="dropdowns"><div id="upBtSp">업로드</div></button><br>
      //     <button id = "msg" class="dropdowns"><div id="msgBtsp">MSG</div></button><br>
      //     <button id = "logout" class="dropdowns"><div id="logBtSp">로그아웃</div></button>
      //   </div>
      // </div>';

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
      $('.headerFrame').css('display','block');
    });
  </script>
