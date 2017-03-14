<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

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

      <div class="headIcons">
        <?php
        echo '<div id = "profile">';
        echo '<img id = "profileImage" src = '.$GLOBALS['photoURL'].'>';
        echo '<div id = "profileName">'.$GLOBALS['name'].'</div>';
        echo '</div>';
        ?>

        <button id = "upload" title="upload"></button>
        <button id = "logout" title="logout"></button>
      </div>
    </div>
  </div>

  <script type = "text/javascript" src = "js/header.js"></script>
  <script type="text/javascript"> //FOUC(Flash Of Unstyled Content) 방지 용
    $(function(){
      $('.headerFrame').css('display','block'); 
    });
  </script>
