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
        $Sentence = "select DISTINCT A.userPK,C.Name,C.Email,C.ProfilePhotoURL,C.Career,C.education,C.isgroup from workDB as A join workDB as B join userinfo as C where A.artPK = B.artPK and C.isgroup = 1 and A.userPK = C.userPK and B.userPK =".$_POST['userPK'];
        $users = DB::select(DB::raw($Sentence));

        if(count($users)>1 and $_SESSION['isGroup']=="Group"){
          echo "<div id = 'group'>";
          echo "<p>group</p>";
        }elseif(count($users)>0 and $_SESSION['isGroup']!="Group"){
          echo "<div id = 'group'>";
          echo "<p>group</p>";
        }

        foreach($users as $A){
          if($A->userPK == $_POST['userPK']){
            continue;
          }
          // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK 6 isgroup
          echo '<a href = "/anotherProfile?int='.$A->userPK.'">';
          echo '<table class="bridgeCard">';
          echo '<tr>';
          echo '<td class="personalImageFrame">';
          echo '<img class="personalImage"src="'.$A->ProfilePhotoURL.'">';
          echo '</td> '.'<td class="personalInfo">';
          echo '<p class="name">'.$A->Name.'</p>';
          echo '<p class="organization">'.$A->Career.'</p>';
          echo '<p class="position">'.$A->education.'</p>';
          echo '</td>';
          echo '</tr>';
          echo '</table>';
          echo '</a>';
        }


        $Sentence = "select DISTINCT A.userPK,C.Name,C.Email,C.ProfilePhotoURL,C.Career,C.education,C.isgroup from workDB as A join workDB as B join userinfo as C where A.artPK = B.artPK and C.isgroup = 0 and A.userPK = C.userPK and B.userPK =".$_POST['userPK'];
        $users = DB::select(DB::raw($Sentence));

        if(count($users)>0){
          echo "</div>";
          echo "<div id = 'person'>";
          echo "<p>person</p>";
        }

        foreach($users as $A){
          if($A->userPK==$_POST['userPK']){
            continue;
          }
          // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK 6 isgroup\
          echo '<a href = "/anotherProfile?int='.$A->userPK.'">';
          echo '<table class="bridgeCard">';
          echo '<tr>';
          echo '<td class="personalImageFrame">';
          echo '<img class="personalImage"src="'.$A->ProfilePhotoURL.'">';
          echo '</td> '.'<td class="personalInfo">';
          echo '<p class="name">'.$A->Name.'</p>';
          echo '<p class="organization">'.$A->Career.'</p>';
          echo '<p class="position">'.$A->education.'</p>';
          echo '</td>';
          echo '</tr>';
          echo '</table>';
          echo '</a>';
        }

        echo "</div>";
      }

    }

    $A = new UserController();
    $A->index();


    ?>
