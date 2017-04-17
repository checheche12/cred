<?php

class UserController
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function userinfoMake(){
        $GLOBALS['userinfoArray']=array();
        $Sentence = "select * from userinfo where userPK = '".$_GET['int']."'";
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $A = array();
          $GLOBALS['isGroup']=$user->isgroup;
          array_push($GLOBALS['userinfoArray'],$user->Email);
          array_push($GLOBALS['userinfoArray'],$user->Name);
          array_push($GLOBALS['userinfoArray'],$user->ProfilePhotoURL);
          array_push($GLOBALS['userinfoArray'],$user->Career);
          array_push($GLOBALS['userinfoArray'],$user->education);
          array_push($GLOBALS['userinfoArray'],$user->userPK);
        }
      }
    }



    ?>
    <head>
      <style type="text/css">
        .noJs {display: none;}
        /*#pfpf{display: none;}*/
        /*#header{display: none;}*/
      </style>
      <script type="text/javascript">
        document.documentElement.className = 'noJs';
      </script>
    </head>
    <!-- <link rel="stylesheet" type ="text/css" href="css/anotherProfile.css"> -->
    <link rel="stylesheet" type ="text/css" href="css/main.css">
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <div id = "header">
      <?php
            include_once('../resources/views/header.php');
            $A = new UserController();
            $A->userinfoMake();
       ?>
    </div>

    <div id = "pfpf" class = "ProfileBasicInfo">
      <?php
            include_once('../resources/views/ProfileAnotherBasicInfo.php');
       ?>
    </div>

    <div id = "profileContent">
      <div id = "profileSelection">
        <ul>
          <li id = "Project">프로젝트</li>
          <li id = "Bridge">크레딧 공유자</li>
          <?php
            if($GLOBALS['isGroup']=="1"){
              echo "<li id = 'Members'>Members</li>";
            }
          ?>
        </ul>
      </div>
      <div id = "profileBody">
      <div id = "projectLayout"></div>
      <div id = "bridgeLayout"></div>

      </div>
    </div>


    <script>
      var userPK = <?=$_GET['int']?>;
    </script>
    <script type = "text/javascript" src = "js/anotherProfile.js"></script>
    <script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
      $(function(){
        $('.noJs').css('display','block');
      });
    </script>
