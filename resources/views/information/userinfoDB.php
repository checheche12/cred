<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class userInfoDBClass extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function userInfoDB()
      {
        $Sentence = "select * from userinfo where userPK = '".$_GET['userPK']."'";
        $userinfo = DB::select(DB::raw($Sentence));
        if($userinfo==NULL){
          die(json_encode('There is no info'));
        }else{
          $userinfoArr = array();
          //0 Email, 1 Name, 2 ProfilePhotoURL, 3 userPK, 4 Career, 5 education, 6 graduateDate, 7 belong, 8 location, 9 isgroup
          foreach($userinfo as $item){
            array_push($userinfoArr,$item->Email);
            array_push($userinfoArr,$item->Name);
            array_push($userinfoArr,$item->ProfilePhotoURL);
            array_push($userinfoArr,$item->userPK);
            array_push($userinfoArr,$item->Career);
            array_push($userinfoArr,$item->education);
            array_push($userinfoArr,$item->graduateDate);
            array_push($userinfoArr,$item->belong);
            array_push($userinfoArr,$item->location);
            array_push($userinfoArr,$item->isgroup);
            die(json_encode($userinfoArr));
          }
        }
      }
    }

    $A = new userInfoDBClass();
    $A->userInfoDB();

    ?>
