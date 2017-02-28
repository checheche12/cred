<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}

class RunQuery extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function Query()
        {
          $Sentence = "update userinfo set ProfilePhotoURL = '".$_POST['ProfilePhotoURL']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));
          
          $Sentence = "update userinfo set Name = '".$_POST['name']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "update userinfo set career = '".$_POST['career']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "update userinfo set education = '".$_POST['education']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "delete from ".$_SESSION['userPK']."keyword";
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "insert into ".$_SESSION['userPK']."keyword (keyword) values ";

          $a = array();
          $a = explode(",",$_POST['keyword']);
          foreach($a as $v1){
            $Sentence.="('".$v1."'),";
          }
          $Sentence = substr($Sentence, 0, -1);
          $users = DB::insert(DB::raw($Sentence));

        }
      }

      $A = new RunQuery();
      $A->Query();

      ?>
