<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class checkAddCredit extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function checkEmailCredit()
        {
          $Sentence = "select * from userinfo where userPK = ".$_GET['userPK'];
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
            $GLOBALS['email'] = $user->Email;
            $GLOBALS['name'] = $user->Name;
            $GLOBALS['career'] = $user->Career;
            $GLOBALS['education'] = $user->education;
            $GLOBALS['photoURL'] = $user->ProfilePhotoURL;
            $GLOBALS['location'] = $user->location;
            $GLOBALS['current_organization'] = $user->belong;
          }

          $Sentence = "select * from keywordDB where userPK = ".$_GET['userPK'];

          $users2 = DB::select(DB::raw($Sentence));
          $GLOBALS['keyword'] = "";
          foreach($users2 as $usera){
            $a=$usera->keyword;
            $GLOBALS['keyword'].=$a.',';
          }
          $GLOBALS['keyword'] = substr($GLOBALS['keyword'],0,-1);

          $Sentence2 = "select * from userExperience where userPK = ".$_GET['userPK'];
          $users2 = DB::select(DB::raw($Sentence2));
          $GLOBALS['exOrganization'] = "";
          $GLOBALS['exPosition'] = "";
          $GLOBALS['exWorkLocation'] = "";
          foreach($users2 as $user){
            $GLOBALS['exOrganization'] = $user->Organization;
            $GLOBALS['exPosition'] = $user->Position;
            $GLOBALS['exWorkLocation'] = '- '.$user->WorkLocation;
          }
        }
      }
      $A = new checkAddCredit();
      $A->checkEmailCredit();
      ?>

      <link rel="stylesheet" type ="text/css" href="css/ProfileBasicInfo.css">

      <?php
      echo '<div class="upperInfo">';
      echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
      echo '<p class="name">'.$GLOBALS['name'].'</p>';
      echo '<p class="curOrganization">'.$GLOBALS['current_organization'].'</p>';
      echo '<p class="curPosition">'.$GLOBALS['career'].'</p>';
      echo '<p class="location">'.$GLOBALS['location'].'</p>';
      echo '</div>';
      echo '<div class="lowerInfo">';
      echo '<div class="infoD"><p class="infoLabel">Contact</p><p class="infoDetail">'.$GLOBALS['email'].'</p></div>';
      echo '<hr>';
      echo '<div class="infoD"><p class="infoLabel">학교</p><p class="infoDetail">'.$GLOBALS['education'].'</p></div>';
      echo '<hr>';
      echo '<div class="infoD"><p class="infoLabel">전문기술</p><p class="infoDetail">'.$GLOBALS['keyword'].'</p></div>';
      echo '<hr>';
      echo '<div class="infoD" id="exInfo">
      <p class="infoLabel">경력</p>
      <div class="exInfoDetail">
        <div class="ex_pos_org">
          <p class="exP">'.$GLOBALS['exPosition'].'&nbsp;</p>
          <p class="exP" class="exOrganization">'.$GLOBALS['exOrganization'].'</p>
        </div><p class="exWorkLocation">'.$GLOBALS['exWorkLocation'].'</p></div></div>';
        echo '</div>';
        ?>

        <script>
          var another = 'yes';
        </script>
        <script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
