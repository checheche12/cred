<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RunQuery extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function Query()
        {

          $Sentence = "update userinfo set Name = '".$_POST['name']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));


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

          if($_SESSION['isGroup']!="Group"){  //개인 개정 수정

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
            /* userExperience Table 수정*/
            if(isset($_POST['experienceArr'])){
              $Array = $_POST['experienceArr'];

              $Sentence = "delete from userExperience where userPK = ".$_SESSION['userPK'];
              $users = DB::delete(DB::raw($Sentence));

            foreach ($Array as $item) { //0 position, 1 organization, 2 exWorkLocation, 3 Detail
              $Insert = DB::insert('insert into userExperience (userPK, Position, Organization, WorkLocation, Explainn) values (?, ?, ?, ?, ?)',array($_SESSION['userPK'],$item[0],$item[1],$item[2],$item[3]));
            }
          }
        }
        if($_SESSION['isGroup']=="Group"){  //구릅 개정 수정

          $Sentence = "delete from awardDB where userPK = ".$_SESSION['userPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "insert into awardDB (award, userPK) values ";

          $a = array();
          $a = explode(",",$_POST['award']);
          foreach($a as $v1){
            $Sentence.="('".$v1."','".$_SESSION['userPK']."'),";
          }
          $Sentence = substr($Sentence, 0, -1);
          $users = DB::insert(DB::raw($Sentence));

          $Sentence = "update userinfo set description = '".$_POST['description']."' where userPK = '".$_SESSION['userPK']."'";
          $users = DB::update(DB::raw($Sentence));
        }
      }
    }

    $A = new RunQuery();
    $A->Query();

    ?>
