<?php
  namespace App\Http\Controllers;
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;

  session_start();

  class UserController extends Controller
  {
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function getUserData()
      {
            $Sentence = "select * from userinfo where userPK = ".$_SESSION['userPK'];
            $users = DB::select(DB::raw($Sentence));
            foreach($users as $user){
                  $GLOBALS['name'] = $user->Name;
                  $GLOBALS['career'] = $user->career;
                  $GLOBALS['education'] = $user->education;
            }
      }
  }

$A = new UserController();
$A->getUserData();

 ?>

<?php
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>
<link rel="stylesheet" type ="text/css" href="css/informationEdit.css">

<div id = "header">

</div>

  <div id = "uploadContent">

      이미지<br><br> <img src = "" id = "profileImage"></img><br><br><br>

      <div id = "uploadSource">

        이름 <input type = "text" value = <?=$GLOBALS['name']?> id = "name"></input><br>
        경력 <input type = "text" value = <?=$GLOBALS['career']?> id = "career"></input><br>
        학력 <input type = "text" value = <?=$GLOBALS['education']?> id = "education"></input><br>

        키워드 <textarea rows="5" cols="30" name="contents">
        </textarea><br>

        <button id="edit">수정</button>

      </div>
  </div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/informationEdit.js"></script>
