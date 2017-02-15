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
          $Sentence = "select * from totalart where artPK = ".$_POST['int'];
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
                $GLOBALS['Title'] = $user->title;
                $GLOBALS['ARTURL'] = $user->ArtURL;
                $GLOBALS['uploadDate'] = $user->uploaddate;
                $GLOBALS['lastloadDate'] = $user->lastloaddate;
                $GLOBALS['Description'] = $user->description;
          }
      }

      public function getWorkList(){
            $workList = array();
            $Sentence2 = "select position, A.userPK, Name from ".$_POST['int']."workDB as A join userinfo as B ON A.userPK = B.userPK";
            $users2 = DB::select(DB::raw($Sentence2));
            foreach($users2 as $user){
                  $imshi = array();
                  $imshi = array($user->position,$user->Name);
                  array_push($workList,$imshi);
            }
      }
  }

?>

<link rel="stylesheet" type ="text/css" href="css/main.css">
<link rel="stylesheet" type ="text/css" href="css/post.css">

  <div id = "header">
    <img id = "credImage" src = "mainImage/CredLogo.jpg">
    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 1)
    -->
    <?php
        echo '<div id = "profile">';
        echo '<img id = "profileImage" src = "mainImage/profile.jpg">';
        echo '<div id = "profileName">mina</div>';
        echo '</div>';
     ?>
  </div>

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
    -->

  <div id = "ContentMain">
      <div id = "first">
        <?php
           $A = new UserController();
           $A->index();
           echo '<img src = '.$GLOBALS['ARTURL'].' width = "700px" height ="700px">'
         ?>
      </div>

      <div id = "second">
          <?php
              echo $GLOBALS['Description'];
          ?>
      </div>

      <div id = "third">

      </div>
  </div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/post.js"></script>
