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
        $Sentence = "select * from totalart where artPK = ".$_GET['int'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $GLOBALS['Title'] = $user->title;
          $GLOBALS['ARTURL'] = $user->ArtURL;
          $GLOBALS['uploadDate'] = $user->uploaddate;
          $GLOBALS['lastloadDate'] = $user->lastloaddate;
          $GLOBALS['Description'] = $user->description;
        }
      }

      public function getWorkNameList(){
        $Sentence2 = "select A.userPK, Name from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        $a = 1;
        foreach($users2 as $user){
          echo "<p class = 'nameFrame' id = ".$user->userPK.">".$user->Name."</p>";
          $a+=1;
        }
        $Sentence2 = "select tagUser from TagNotUser where artPK =".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'nameFrame2'>".$user->tagUser."</p>";
        }
      }

      public function getWorkPositionList(){
        $Sentence2 = "select position from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'positionFrame'>".$user->position."</p>";
        }
        $Sentence2 = "select position from TagNotUser where artPK =".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'positionFrame'>".$user->position."</p>";
        }
      }

      public function getUserCreditList(){
        $Sentence2 = "select B.userPK from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $GLOBALS['userPKArray'] = array();
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          array_push($GLOBALS['userPKArray'],$user->userPK);
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
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <link rel="stylesheet" type ="text/css" href="css/main.css">
    <link rel="stylesheet" type ="text/css" href="css/post.css">

    <div id ='header'>

    </div>
    <div><button id="close">X</button></div>

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
      -->

      <div id = "ContentMain">
        <div id = "first">
          <?php
          $A = new UserController();
          $A->index();
          ?>
          <script>
            var SourceURL = "<?= $GLOBALS['ARTURL'] ?>";
          </script>

        </div>

        <div id = "second">
          <?php
          echo $GLOBALS['Title'];
          ?>
        </div>

        <div id = "third">
          <div class="outCreditFrame">

            <div class="creditFrame">
              <p class="credit">Credit</p>
              <div class="positionFrame" id="positionFrame">
                <p class="titleText">position</p>
                <?php
                $A->getWorkPositionList();
                ?>
              </div>
              <div class="nameFrame" id="nameFrame">
                <p class="titleText">name</p>
                <?php
                $A->getWorkNameList();
                ?>
              </div>
            </div>
          </div>
          <div id="description">"<?= $GLOBALS['Description']?>"</div>
        </div>

        <!--
          수정, 삭제 버튼이 여기서 달려있게 된다.
        -->
        <div>
          <?php
          $A->getUserCreditList();
          foreach($GLOBALS['userPKArray'] as $user){
            if($user == $_SESSION['userPK']){
              echo '<button id="fixed">수정</button>';
              echo '<button id="delete">삭제</button>';
              break;
            }
          }
          ?>
        </div>

      </div>

      <script>
        var ArtPK =<?=$_GET['int']?>;
        var userPKArr = new Array("<?=implode("\",\"" , $GLOBALS['userPKArray']);?>");
      </script>

      <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type = "text/javascript" src = "js/post.js"></script>
   <script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
    $(function(){
      $('.noJs').css('display','block');
    });
  </script>
