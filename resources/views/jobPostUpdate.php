<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class jobPostUpdateClass extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function jobPostUpdate()
        {
          if($_POST['controlType']=="insert"){

          //String -> Date
            $tempDate = $_POST['expiryDate'];
            $expiryDate = date('Y-m-d H:i:s', strtotime($tempDate));

            DB::insert('insert into jobPostDB (userPK, postPurpose, recruiterName, workField, companyInfo, position, jobDesc, workLocation, jobType, jobPeriod, earning, benefits, expiryDate, education, experience, extraDesc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',array($_SESSION['userPK'],$_POST['postPurpose'],$_POST['recruiterName'],$_POST['workField'],$_POST['companyInfo'],$_POST['position'],$_POST['jobDesc'],$_POST['workLocation'],$_POST['jobType'],$_POST['jobPeriod'],$_POST['earning'],$_POST['benefits'],$expiryDate,$_POST['education'],$_POST['experience'],$_POST['extraDesc']));
            $jobPostPK = '';
          //selecting last primary Key = jobPostPK
            $temp = DB::select(DB::raw("select LAST_INSERT_ID()"));
            foreach($temp as $v1){
              foreach($v1 as $v2){
                $jobPostPK = $v2;
                break;
              }
              break;
            }
          //skill 따로 추가 qualSkillDB (qualificationSkillDB 를 줄임)에 추가
            $Sentence = "insert into qualSkillDB (skill, jobPostPK) values ";

            $a = array();
            $a = explode(",",$_POST['skill']);
            foreach($a as $v1){
             $Sentence.="('".$v1."','".$jobPostPK."'),";
           }
           $Sentence = substr($Sentence, 0, -1);
           $users = DB::insert(DB::raw($Sentence));
         }elseif ($_POST['controlType']=="delete") {

          $Sentence = "delete from jobPostDB where jobPostPK = ".$_POST['jobPostPK'];
          DB::delete(DB::raw($Sentence));

        }elseif ($_POST['controlType']=="update") {
           # code...
          $tempDate = $_POST['expiryDate'];
          $expiryDate = date('Y-m-d H:i:s', strtotime($tempDate));
          $Sentence = "update jobPostDB SET postPurpose = '".$_POST['postPurpose']."', recruiterName = '".$_POST['recruiterName']."', workField = '".$_POST['workField']."',companyInfo = '".$_POST['companyInfo']."', position = '".$_POST['position']."', jobDesc = '".$_POST['jobDesc']."',workLocation = '".$_POST['workLocation']."', jobType = '".$_POST['jobType']."', jobPeriod = '".$_POST['jobPeriod']."',earning = '".$_POST['earning']."', benefits = '".$_POST['benefits']."', expiryDate = '".$expiryDate."',education = '".$_POST['education']."', experience = '".$_POST['experience']."', extraDesc = '".$_POST['extraDesc']."' WHERE jobPostPK = ".$_POST['jobPostPK'];
          $users = DB::update(DB::raw($Sentence));
////////////////////
          //skill 따로 추가 qualSkillDB (qualificationSkillDB 를 줄임)에 추가
          DB::delete(DB::raw("delete from qualSkillDB where jobPostPK='".$_POST['jobPostPK']."'"));
          $Sentence = "insert into qualSkillDB (skill, jobPostPK) values ";

          $a = array();
          $a = explode(",",$_POST['skill']);
          foreach($a as $v1){
           $Sentence.="('".$v1."','".$_POST['jobPostPK']."'),";
         }
         $Sentence = substr($Sentence, 0, -1);
         $users = DB::insert(DB::raw($Sentence));

       }

     }
   }

   $A = new jobPostUpdateClass();
   $A->jobPostUpdate();

   ?>