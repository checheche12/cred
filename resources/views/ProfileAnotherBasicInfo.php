<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class checkAddCredit extends Controller
{
        /**
         * Show a list of all of the application's users.
         *
         * @return Response
         */
        public function checkEmailCredit()
        {
          $Sentence = "select * from userinfo where userPK = ".$_GET['int'];
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
            $GLOBALS['email'] = $user->Email;
            $GLOBALS['name'] = $user->Name;
            $GLOBALS['career'] = $user->Career;
            $GLOBALS['education'] = $user->education;
            $GLOBALS['photoURL'] = $user->ProfilePhotoURL;
            $GLOBALS['location'] = $user->location;
            $GLOBALS['current_organization'] = $user->belong;
            $GLOBALS['isGroup'] = $user->isgroup;
          }

          $Sentence = "select * from keywordDB where userPK = ".$_GET['int'];

          $users2 = DB::select(DB::raw($Sentence));
              // $GLOBALS['keyword'] = "";
          $GLOBALS['keywordArr'] =array();
          foreach($users2 as $usera){
            array_push($GLOBALS['keywordArr'], $usera->keyword);
          }

          $Sentence = "select * from awardDB where userPK = ".$_GET['int'];

          $users2 = DB::select(DB::raw($Sentence));
          $GLOBALS['awardArr'] =array();
          foreach($users2 as $usera){
            array_push($GLOBALS['awardArr'], $usera->award);
          }

          $Sentence2 = "select * from userExperience where userPK = ".$_GET['int'];
          $users2 = DB::select(DB::raw($Sentence2));

          $GLOBALS['experienceArr']=array();
          foreach($users2 as $user){
            array_push($GLOBALS['experienceArr'],array($user->Position,$user->Organization,$user->WorkLocation));
          }

          if($GLOBALS['isGroup']=="1"){
            $Sentence3 = "select description from userinfo where userPK = ".$_GET['int'];
            $users3 = DB::select(DB::raw($Sentence3));
            $GLOBALS['description'] = "";
            foreach($users3 as $user){
              $GLOBALS['description'] = $user->description;
              if(!isset($GLOBALS['description'])){
                $GLOBALS['description'] = ' ';
              }
              break;
            }

          }
        }
      }

      $ProfileAnother = new checkAddCredit();
      $ProfileAnother->checkEmailCredit();

      ?>

      <head>
        <style type="text/css">
          .profileFrame{
            display: none;
          }
        </style>
      </head>

      <link rel="stylesheet" type ="text/css" href="css/ProfileBasicInfo.css">

      <?php
      echo '<div class="profileFrame">';
      echo '<div class="upperInfo">';
      echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
      echo '<p class="name">'.$GLOBALS['name'].'</p>';
      echo '<p id="curOrganization" class="curOrganization">'.$GLOBALS['current_organization'].'</p>';
      echo '<p id="curPosition" class="curPosition">'.$GLOBALS['career'].'</p>';
      echo '<p id="location" class="location">'.$GLOBALS['location'].'</p>';
      echo '</div>';
      echo '<div class="lowerInfo">';
      echo '<div class="infoD"><p class="infoLabel"><img id="contacticon" src="/mainImage/airplaneicon.png">연락처</p><p class="infoDetail">'.$GLOBALS['email'].'</p></div>';
      if($GLOBALS['isGroup']=="0"){ //개인일 시
        echo '<hr id="infoSplit">';
        echo '<div class="infoD"><p class="infoLabel"><img id="educationicon" src="/mainImage/educationicon.png">학교</p><p id="educationInfo" class="infoDetail">'.$GLOBALS['education'].'</p></div>';
        echo '<hr id="infoSplit">';
        echo '<div class="infoD"><p class="infoLabel"><img id="skillicon" src="/mainImage/skillicon.png">전문기술</p><div id="specialtyInfo" class="infoDetail">';
        $i = 0;
        foreach ($GLOBALS['keywordArr'] as $temp) {
          echo '<p id="specialty'.$i.'" class="specialty">'.$temp.'</p>';
          $i++;
        # code...
        }
        echo'</div></div>';
        echo '<hr id="infoSplit">';

        echo '<div class="infoD" id="exInfo">
        <p class="infoLabel"><img id="workicon" src="/mainImage/workicon.png">경력</p>';
        $i = 0;
        foreach ($GLOBALS['experienceArr'] as $temp) {
          echo'<div class="exInfoDetail">
          <div class="ex_pos_org">
            <p id="exPosition'.$i.'" class="exP">'.$temp[0].'&nbsp;</p>
            <p id="exOrganization'.$i.'" class="exP" class="exOrganization">'.$temp[1].'</p>
          </div><p id="exWorkLocation'.$i.'" class="exWorkLocation">'.$temp[2].'</p></div>';
          $i++;
        }
      } // if PERSON end

      if($GLOBALS['isGroup']=="1"){ //그룹일 시
        //keyword starts
        echo '<hr id="infoSplit">
        <div class="infoD"><p class="infoLabel"><img id="skillicon" src="/mainImage/skillicon.png">키워드</p><div id="specialtyInfo" class="infoDetail">';
          $i = 0;
          foreach ($GLOBALS['keywordArr'] as $temp) {
            echo '<p id="specialty'.$i.'" class="specialty">'.$temp.'</p>';
            $i++;
        # code...
          }
          echo'</div></div>'; //keyword end

          //Awards starts
          echo '<hr id="infoSplit">
          <div class="infoD"><p class="infoLabel"><img id="awardicon" src="/mainImage/awardicon.png">Awards</p><div id="awardInfo" class="infoDetail">';
            $i = 0;
            foreach ($GLOBALS['awardArr'] as $temp) {
              echo '<p id="award'.$i.'" class="award">'.$temp.'</p>';
              $i++;
        # code...
            }
          echo'</div></div>'; //Awards end

          echo'<hr id="infoSplit">
          <div class="infoD"><p class="infoLabel"><img id="workicon" src="/mainImage/workicon.png">그룹소개</p><p class="infoDetail">'.$GLOBALS['description'].'</p></div>';
        }// if GROUP end
        echo '</div></div></div>';  //lowerInfo division end
        ?>

        <script>
          var another = 'yes';
        </script>
        <script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
        <script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용

          $(function(){
            $('.profileFrame').css('display','block');
          });
        </script>
