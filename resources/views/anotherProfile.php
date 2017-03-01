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

      public function userinfoMake(){
          $GLOBALS['userinfoArray']=array();
          $Sentence = "select * from userinfo where userPK = '".$_POST['int']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
              $A = array();
              array_push($GLOBALS['userinfoArray'],$user->Email);
              array_push($GLOBALS['userinfoArray'],$user->Name);
              array_push($GLOBALS['userinfoArray'],$user->ProfilePhotoURL);
              array_push($GLOBALS['userinfoArray'],$user->Career);
              array_push($GLOBALS['userinfoArray'],$user->education);
              array_push($GLOBALS['userinfoArray'],$user->userPK);
          }
      }
}

$A = new UserController();
$A->userinfoMake();

?>
<link rel="stylesheet" type ="text/css" href="css/anotherProfile.css">

      <div id = "header">

      </div>

      <div id = "pfpf" class = "ProfileBasicInfo">

      </div>

      <div id = "profileContent">
        <div id = "profileSelection">
          <ul>
            <li id = "Project">Project</li>
            <li id = "Bridge">Bridge</li>
          </ul>
        </div>
        <div id = "profileBody">
          <?php

          ?>
        </div>
      </div>


<script>
  var userPK = <?=$_POST['int']?>;
</script>
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/anotherProfile.js"></script>
