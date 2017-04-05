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
        $Sentence = "select Name from userinfo where userPK = ".$_SESSION['userPK'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $Name = $user->Name;
          break;
        }
        $GLOBALS['TagNotUser'] = array();

        $Sentence = "select * from TagNotUser where tagUser = '".$Name."'";
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $imshi = array();
          array_push($imshi,$user->tagPK);
          array_push($imshi,$user->tagUser);
          array_push($imshi,$user->ArtPK);

          $Sentence2 = "select ArtURL from totalart where artPK = ".$user->ArtPK;
          $users2 = DB::select(DB::raw($Sentence2));
          $ArtURL = '';
          foreach($users2 as $usera){
            $ArtURL = $usera->ArtURL;
            break;
          }
          array_push($imshi,$ArtURL);
          array_push($imshi,$user->position);
          array_push($GLOBALS['TagNotUser'],$imshi);
        }

      }

}

$A = new UserController();
$A->index();

?>
<!-- FOUC(Flash Of Unstyled Content) 방지 용 head-->
<head>
<link href=“https://fonts.googleapis.com/css?family=Montserrat|Roboto” rel=“stylesheet” type="text/css">
  <style type="text/css">
    .noJs {display: none;}
    /*#pfpf{display: none;}*/
    /*#header{display: none;}*/
  </style>
  <script type="text/javascript">
    document.documentElement.className = 'noJs';
  </script>
</head>

<!-- Facebook API -->
<script>


  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '278220249266484',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" type ="text/css" href="css/yourart.css?v=1">

<div id ='header'>

</div>
    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
      -->
      <div id = "pfpf" class = "ProfileBasicInfo">
      </div>

      <?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

      ?>

      <div id = "totalsuggest" class = "total">

      </div>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script>
  var userPK = <?=$_SESSION['userPK']?>;
  var NotTagArt = <?=JSON_encode($GLOBALS['TagNotUser']) ?>;
</script>
<script type = "text/javascript" src = "js/makedFunction.js"></script>
<script type = "text/javascript" src = "js/yourart.js"></script>
<script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
  $(function(){
    $('.noJs').css('display','block');
  });
</script>
