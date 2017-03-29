<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

// if(!isset($_SESSION['is_login'])){
//   header('Location: ./');
//   exit;
// }

class newMember extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function checkEmailExistence()
      {
        // echo "<script>console.log( 'TESTING CONNECTION: ".$_POST['email']."||".$_POST['name']."' );</script>";
        // echo "<h3> TESTING FACEBOOK </h3>";

        $Sentence = "select Name,userPK from userinfo where Email = '".$_POST['email']."'";
        $users = DB::select(DB::raw($Sentence));
        if($users==NULL){ //Facebook으로 로그인하려고 하는데 CRED 에 아직 계정이 없는 경우
          /** cred 계정 생성, 비밀번호는 임시 생성 (oAuth/ Acess Token 어떻게 다루는지 알아봐야함)**/

          echo "<h3> 계정이 없음... 생성중... </h3>";
          DB::insert('insert into userinfo (Email, Password, Name, Certification) values (?, ?, ?, ?)',[$_POST['email'],'facebooklogin',$_POST['name'],1]);


          /**userExperience Table에 userPK 추가**/
          $Sentence = "select userPK from userinfo where Email = '".$_POST['email']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
          DB::insert('insert into userExperience (userPK) values ('.$GLOBALS['userPK'].')');

          // 아이디 만들었으니 바로 로그인 시키기
          $_SESSION['is_login'] = true;
          $_SESSION['userPK'] = $GLOBALS['userPK'];
          header('Location: ./main');
          exit;


        }else{//Facebook으로 로그인하려고 하는데 CRED 에 계정이 벌써 있는 경우
          //아이디 찾아서 로그인 시키기


          $Sentence = "select userPK from userinfo where Email = '".$_POST['email']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}

          $_SESSION['is_login'] = true;
          $_SESSION['userPK'] = $GLOBALS['userPK'];
          $_SESSION['isGroup'] = "person";
          echo "<h3> 계정이 있음... 로딩중... </h3>";
          header('Location: ./main');
          exit;
          echo "<h3> final point </h3>";

        }
      }

    }

    $A = new newMember();
    $A->checkEmailExistence();

    ?>
