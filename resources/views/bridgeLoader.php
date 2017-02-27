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
        $GLOBALS['userPKArray']=array();
        $Sentence = "select artPK from ".$_POST['userPK']."artDB";
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
            $Sentence = "select userPK from ".$user->artPK."workDB";
            $V = DB::select(DB::raw($Sentence));
            foreach($V as $v1){
                  array_push($GLOBALS['userPKArray'],$v1->userPK);
            }
        }
      }

      public function userinfoMake(){
          $GLOBALS['userinfoArray']=array();
          foreach($GLOBALS['userPKArray'] as $k){
                $Sentence = "select * from userinfo where userPK = '".$k."'";
                $users = DB::select(DB::raw($Sentence));
                foreach($users as $user){
                  $A = array();
                  array_push($A,$user->Email);
                  array_push($A,$user->Name);
                  array_push($A,$user->ProfilePhotoURL);
                  array_push($A,$user->career);
                  array_push($A,$user->education);
                  array_push($A,$user->userPK);
                  array_push($GLOBALS['userinfoArray'],$A);
                }
          }
      }
}

$A = new UserController();
$A->index();

$GLOBALS['userPKArray']=array_unique($GLOBALS['userPKArray']);

$A->userinfoMake();

die(json_encode($GLOBALS['userinfoArray'],JSON_UNESCAPED_UNICODE));
?>
