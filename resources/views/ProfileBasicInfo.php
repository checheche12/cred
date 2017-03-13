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
          $Sentence = "select * from userinfo where userPK = ".$_SESSION['userPK'];
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
            $GLOBALS['email'] = $user->Email;
            $GLOBALS['name'] = $user->Name;
            $GLOBALS['career'] = $user->Career;
            $GLOBALS['education'] = $user->education;
            $GLOBALS['photoURL'] = $user->ProfilePhotoURL;
          }

          $Sentence = "select * from keywordDB where userPK = ".$_SESSION['userPK'];

          $users2 = DB::select(DB::raw($Sentence));
          $GLOBALS['keyword'] = "";
          foreach($users2 as $usera){
            $a=$usera->keyword;
            $GLOBALS['keyword'].=$a.',';
          }
          $GLOBALS['keyword'] = substr($GLOBALS['keyword'],0,-1);
        }
      }

      $A = new checkAddCredit();
      $A->checkEmailCredit();
      ?>

      <link rel="stylesheet" type ="text/css" href="css/ProfileBasicInfo.css">

<!-- <?php
    // echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
    // echo '<p class="name">'.$GLOBALS['name'].'</p>';
    // echo '<p class="organization">'.$GLOBALS['education'].'</p>';
    // echo '<p class="position">'.$GLOBALS['career'].'</p>';

    // echo '<p class="location">GangNam</p>';
    // echo '<p class="email">'.$GLOBALS['email'].'</p>';
    // echo '<button id = "informationEdit">프로필 수정하기</button>';
    // echo '<hr>';
    // echo '<p class="personalDescription">'.$GLOBALS['keyword']."</p>"
?>
-->
<?php
echo '<div class="upperInfo">';
echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
echo '<p class="name">'.$GLOBALS['name'].'</p>';
      // echo '<p class="curOrganization">'.$GLOBALS['curOrganization'].'</p>';
echo '<p class="curOrganization">curOrganization</p>';
      // echo '<p class="curPosition">'.$GLOBALS['curPosition'].'</p>';
echo '<p class="curPosition">curPosition</p>';

echo '<p class="location">location</p>';
echo '</div>';
echo '<div class="lowerInfo">';
echo '<div class="infoD"><p class="infoLabel">Contact</p><p class="infoDetail">'.$GLOBALS['email'].'</p></div>';
echo '<hr>';
echo '<div class="infoD"><p class="infoLabel">학교</p><p class="infoDetail">'.$GLOBALS['education'].'</p></div>';
echo '<hr>';
echo '<div class="infoD"><p class="infoLabel">전문기술</p><p class="infoDetail">'.$GLOBALS['keyword'].'</p></div>';
echo '<hr>';
echo '<div class="infoD" id="exInfo"><p class="infoLabel">경력</p><div id="exInfoDetail"><p class="exP">exPosition</p><p class="exP" id="exOrganization">exOrganization</p></div></div>';
// echo '<p class="exPosition">exPosition</p>';
// echo '<p class="exOrganization">exOrganization</p>';
echo '</div>';

echo '<button id = "informationEdit">프로필 수정하기</button>';
?>

<script>
  var another = 'no';
</script>
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
