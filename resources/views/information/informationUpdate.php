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

          $Sentence = "update userinfo set belong = '".$_POST['current_organization']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          // if($_POST['education2']!=null){
          //       $Sentence = "update userinfo set graduateDate = ".$_POST['education2']." where userPK = '".$_SESSION['userPK']."'";
          //       $users = DB::update(DB::raw($Sentence));
          // }

          $Sentence = "update userinfo set location = '".$_POST['location']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "delete from keywordDB where userPK = ".$_SESSION['userPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "insert into keywordDB (keyword, userPK) values ";

          $a = array();
          $a = explode(",",$_POST['keyword']);
          foreach($a as $v1){
            $Sentence.="('".$v1."','".$_SESSION['userPK']."'),";
          }
          $Sentence = substr($Sentence, 0, -1);
          $users = DB::insert(DB::raw($Sentence));

          /* userExperience Table 수정*/
          $Sentence = "update userExperience set Position = '".$_POST['exPosition']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "update userExperience set Organization = '".$_POST['exOrganization']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "update userExperience set WorkLocation = '".$_POST['exWorkLocation']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));

          $Sentence = "update userExperience set Explainn = '".$_POST['explainn']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));
        }
      }

      $A = new RunQuery();
      $A->Query();

      ?>
