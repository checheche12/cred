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
                  $GLOBALS['career'] = $user->career;
                  $GLOBALS['education'] = $user->education;
                  $GLOBALS['photoURL'] = $user->ProfilePhotoURL;
            }

            $Sentence = "select * from ".$_GET['userPK']."keyword";

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

<?php
    echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
    echo '<p class="name">'.$GLOBALS['name'].'</p>';
    echo '<p class="organization">'.$GLOBALS['education'].'</p>';
    echo '<p class="position">'.$GLOBALS['career'].'</p>';

    echo '<p class="location">GangNam</p>';
    echo '<p class="email">'.$GLOBALS['email'].'</p>';
    echo '<hr>';
    echo '<p class="personalDescription">'.$GLOBALS['keyword']."</p>"
?>

<script>
  var another = 'yes';
</script>
<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
