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

          $Sentence = "select * from userinfo where userPK = ".$_SESSION['userPK'];
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){
            $GLOBALS['email'] = $user->Email;
            $GLOBALS['name'] = $user->Name;
            $GLOBALS['career'] = $user->Career;
            $GLOBALS['education'] = $user->education;
            $GLOBALS['photoURL'] = $user->ProfilePhotoURL;
            $GLOBALS['location'] = $user->location;
            $GLOBALS['current_organization'] = $user->belong;
            $GLOBALS['userPK'] = $user->userPK;
          }

          $Sentence = "select * from keywordDB where userPK = ".$_SESSION['userPK'];

          $users2 = DB::select(DB::raw($Sentence));
              // $GLOBALS['keyword'] = "";
          $GLOBALS['keywordArr'] =array();
          foreach($users2 as $usera){
            array_push($GLOBALS['keywordArr'], $usera->keyword);
          }

          $Sentence = "select * from awardDB where userPK = ".$_SESSION['userPK'];

          $users2 = DB::select(DB::raw($Sentence));
          $GLOBALS['awardArr'] =array();
          foreach($users2 as $usera){
            array_push($GLOBALS['awardArr'], $usera->award);
          }

          $Sentence2 = "select * from userExperience where userPK = ".$_SESSION['userPK'];
          $users2 = DB::select(DB::raw($Sentence2));

          $GLOBALS['experienceArr']=array();
          foreach($users2 as $user){
            array_push($GLOBALS['experienceArr'],array($user->Position,$user->Organization,$user->WorkLocation));
          }

          if($_SESSION['isGroup']=="Group"){
            $Sentence3 = "select description from userinfo where userPK = ".$_SESSION['userPK'];
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

          $GLOBALS['MyGroups'] = DB::select('select * from groupMemberDB left join
            userinfo on groupPK = userinfo.userPK
            where groupMemberDB.userPK = ?',[$_SESSION['userPK']]);
        }
      }

      $A = new checkAddCredit();
      $A->checkEmailCredit();
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

      if($GLOBALS['userPK']==$_SESSION['userPK']){
        echo '<img id = "profileImage2" style="margin-left:30px;" src = '.$GLOBALS['photoURL'].'>';
      }else{
        echo '<img id = "profileImage2" src = '.$GLOBALS['photoURL'].'>';
      }
      echo '<button id = "informationEdit"></button>';
      echo '<p class="name">'.$GLOBALS['name'].'</p>';
      echo '<p id="curOrganization" class="curOrganization">'.$GLOBALS['current_organization'].'</p>';
      if($GLOBALS['current_organization']!=NULL and $GLOBALS['location']!=NULL){
        echo'<p class="comma">,&nbsp;</p>';
      }
      echo '<p id="location" class="location">'.$GLOBALS['location'].'</p>';
      echo '<p id="curPosition" class="curPosition">'.$GLOBALS['career'].'</p>';
      foreach($GLOBALS['MyGroups'] as $MyGroup){
        echo '<div class = "myGroup">
        <p class = "infoLabel"><img class = "infoIconClass" src = "/mainImage/group.png">소속 그룹</img></p><a href = "/anotherProfile?int='.$MyGroup->groupPK.'"><p class = "infoDetail">'.$MyGroup->Name.'</p></a>
      </div>'
      ;
    }
    echo '</div>';
    echo '<div class="lowerInfo">';

      //연락처 숨기기로 함: 조건??
      // echo '<div class="infoD"><p class="infoLabel"><img id="contacticon" class="infoIconClass" src="/mainImage/airplaneicon.png">연락처</p><p id="emailP" class="infoDetail">'.$GLOBALS['email'].'</p></div>';

    if($_SESSION['isGroup']!="Group"){
        if($GLOBALS['education']!=NULL){ //학력 비어 있을 시 학력란을 아에 띄우지 않음.
          echo '<hr id="infoSplit">';
          echo '<div class="infoD"><p class="infoLabel"><img id="educationicon" class="infoIconClass" src="/mainImage/educationicon.png">학교</p><p id="educationInfo" class="infoDetail">'.$GLOBALS['education'].'</p></div>';
        }
        echo '<hr id="infoSplit">';
        echo '<div class="infoD"><p class="infoLabel"><img id="skillicon" class="infoIconClass" src="/mainImage/skillicon.png">전문기술</p><div id="specialtyInfo" class="infoDetail specialtyInfo">';
        $i = 0;
        foreach ($GLOBALS['keywordArr'] as $temp) {
          echo '<p id="specialty'.$i.'" class="specialty">'.$temp.'</p>';
          $i++;
        # code...
        }
        echo'</div></div>';
        echo '<hr id="infoSplit">';

        echo '<div class="infoD" id="exInfo">
        <p class="infoLabel"><img id="workicon" class="infoIconClass" src="/mainImage/workicon.png">경력</p>';
        $i = 0;
        foreach ($GLOBALS['experienceArr'] as $temp) {
          echo'<div class="exInfoDetail">
          <div class="ex_pos_org">
            <p id="exOrganization'.$i.'" class="exO">'.$temp[1].'</p>';
            if($temp[1]!=NULL and $temp[2]!=NULL){
              echo'<p class="comma">,&nbsp;</p>';
            }
            echo'<p id="exWorkLocation'.$i.'" class="exL">'.$temp[2].'</p>
          </div>
          <p id="exPosition'.$i.'" class="exP">'.$temp[0].'</p>
        </div>';
        $i++;
      }
      echo '</div>';



      } // if PERSON end

      if($_SESSION['isGroup']=="Group"){
        //keyword starts
        echo '<hr id="infoSplit">
        <div class="infoD"><p class="infoLabel"><img id="skillicon" class="infoIconClass" src="/mainImage/skillicon.png">키워드</p><div id="specialtyInfo" class="infoDetail">';
          $i = 0;
          foreach ($GLOBALS['keywordArr'] as $temp) {
            echo '<p id="specialty'.$i.'" class="specialty">'.$temp.'</p>';
            $i++;
        # code...
          }
          echo'</div></div>'; //keyword end

          //Awards starts
          if(count($GLOBALS['awardArr'])!=0){

            echo '<hr id="infoSplit">
            <div class="infoD"><p class="infoLabel"><img id="awardicon" class="infoIconClass" src="/mainImage/awardicon.png">수상경력</p><div id="awardInfo" class="infoDetail">';
              $i = 0;
              foreach ($GLOBALS['awardArr'] as $temp) {
                echo '<p id="award'.$i.'" class="award">'.$temp.'</p>';
                $i++;
        # code...
              }
              echo'</div></div>';
          } //Awards end

          echo'<hr id="infoSplit">
          <div class="infoD"><p class="infoLabel"><img id="workicon" class="infoIconClass" src="/mainImage/workicon.png">그룹소개</p><p class="infoDetail">'.$GLOBALS['description'].'</p></div>';
          echo '</div>';
        }// if GROUP end
        echo '</div></div>';  //lowerInfo division end
        ?>

        <script>
          var another = 'no';
          var specialty = <?php echo json_encode($GLOBALS['keywordArr'])?>;
          //array 로 뜸.. 왜그러지?
        </script>
        <script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
      <script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용

        $(function(){
          $('.profileFrame').css('display','block');
        });
      </script>
