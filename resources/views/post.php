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

      public function getWorkNameList(){
        $Sentence2 = "select position, A.userPK, Name from ".$_POST['int']."workDB as A join userinfo as B ON A.userPK = B.userPK";
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'nameFrame'>".$user->Name."</p>";
        }
      }

      public function getWorkPositionList(){
        $Sentence2 = "select position, A.userPK, Name from ".$_POST['int']."workDB as A join userinfo as B ON A.userPK = B.userPK";
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'positionFrame'>".$user->position."</p>";
        }
      }

    }

    ?>

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

        <div>
          <div id = "third">
            <div class="creditFrame">
              <p class="credit">Credit</p>
              <div class="positionFrame">
                <p class="titleText">position</p>
                <?php
                $A->getWorkPositionList();
                ?>
              </div>
              <div class="nameFrame">
                <p class="titleText">name</p>
                <?php
                $A->getWorkNameList();
                ?>
              </div>
            </div>
            <div id="description">"<?= $GLOBALS['Description']?>"</div>
          </div>

          <br><br><br>
          <div>
            <input id="position" placeholder="담당 position"></input>
            <input id="Email" placeholder="계졍 Email"></input>
            <button id="addCredit">creidt 추가</button>
          </div>
        </div>

      </div>


      <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
      <script type = "text/javascript" src = "js/post.js"></script>
