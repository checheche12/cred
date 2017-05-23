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

          // anotherProfile 의 유저와 Session에 저장된 유저의 관계를 파악해야하는데
          // 자기 자신일 수는 없다 MiddleWare 단계에서 이미 걸러내서 자기 자신이면 main 으로 보내버리니까.
          // 4가지의 상태가 있는데
          // 1번은 무관 2번은 connect 되어있음 3번은 같이 작품을 함 4번은 그룹의 멤버.
          $selectConnect = DB::select('select * from Connect where connectSenduserPK = ? and connectRecieveruserPK = ?',[$_SESSION['userPK'],$_GET['int']]);
          $GLOBALS['stats'] = "인맥 추가";
          if($selectConnect != null){
            foreach($selectConnect as $select){

              if($select->stats == "0"){
                $GLOBALS['stats'] = "인맥 요청함";
              }else if($select->stats == "1"){
                $GLOBALS['stats'] = "요청 받음";
              }else if($select->stats == "2"){
                $GLOBALS['stats'] = "인맥";
              }

            }

          }
          $connectCredit = DB::select('select * from workDB as A left join workDB as B on A.artPK = B.artPK
          where A.userPK = ? and B.userPK = ? and B.checkCredit = 1;',[$_SESSION['userPK'],$_GET['int']]);
          if($connectCredit != null){
            $GLOBALS['stats'] = "크레딧 공유됨";
          }

          if($_SESSION['isGroup'] == "Group"){
              $checkGroupMember =  DB::select("select * from groupMemberDB where groupPK = ? and userPK = ?",[$_SESSION['userPK'],$_GET['int']]);
              if($checkGroupMember  != null){
                $GLOBALS['stats'] = "GroupMember";
              }
          }

          if($_SESSION['isGroup'] == "Person"){
              $checkGroupMember =  DB::select("select * from groupMemberDB where groupPK = ? and userPK = ?",[$_GET['int'],$_SESSION['userPK']]);
              if($checkGroupMember != null){
                $GLOBALS['stats'] = "Belonged";
              }
          }

          $GLOBALS['MyGroups'] = DB::select('select * from groupMemberDB left join
          userinfo on groupPK = userinfo.userPK
          where groupMemberDB.userPK = ?',[$_GET['int']]);

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
      if($GLOBALS['current_organization']!=NULL and $GLOBALS['location']!=NULL){
        echo'<p class="comma">,&nbsp;</p>';
      }
      echo '<p id="location" class="location">'.$GLOBALS['location'].'</p>';
      echo '<p id="curPosition" class="curPosition">'.$GLOBALS['career'].'</p>';
      echo '</div>';
      //DM과 connect 기능이 들어간다.

      echo '<div>';
      echo '<button id = "DirectMessage">메세지</button>';
      //Connect 종류에 따라서 그룹 멤버인지 아닌지 connect 상태인지가 드러나야한다.

      // if문으로 버튼 상태를 구현해주어야 한다.
      if($GLOBALS['stats'] == "요청 받음"){
        echo '<div id = "applyRespond"><button class = "connect Hover" stats = "'.$GLOBALS['stats'].'" id = "connectapply">인맥 수락</button>';
        echo '<button class = "connect Hover" stats = "'.$GLOBALS['stats'].'" id = "connectdeny">인맥 거절</button>';
        echo '</div>';
      }else if($GLOBALS['stats'] == "크레딧 공유됨"){
        echo '<button class = "connect noHover" stats = "'.$GLOBALS['stats'].'" id = "creditSharin">'.$GLOBALS['stats'].'</button>';
      }else if($GLOBALS['stats'] == "인맥"){
        echo '<button class = "connect noHover" stats = "'.$GLOBALS['stats'].'" id = "connectedMember">'.$GLOBALS['stats'].'</button>';
      }else if($GLOBALS['stats'] == "인맥 요청함"){
        echo '<button class = "connect noHover" stats = "'.$GLOBALS['stats'].'" id = "connectPending">'.$GLOBALS['stats'].'</button>';
      }else if($GLOBALS['stats'] == "인맥 추가"){
        echo '<button class = "connect Hover" stats = "'.$GLOBALS['stats'].'" id = "connect">'.$GLOBALS['stats'].'</button>';
      }
      echo '</div>';

      echo '<div class="lowerInfo">';
      echo '<div class="infoD"><p class="infoLabel"><img id="contacticon" class="infoIconClass" src="/mainImage/airplaneicon.png">연락처</p><p id="emailP" class="infoDetail">'.$GLOBALS['email'].'</p></div>';
      if($GLOBALS['isGroup']=="0"){ //개인일 시
        echo '<hr id="infoSplit">';
        echo '<div class="infoD"><p class="infoLabel"><img id="educationicon" class="infoIconClass" src="/mainImage/educationicon.png">학교</p><p id="educationInfo" class="infoDetail">'.$GLOBALS['education'].'</p></div>';
        echo '<hr id="infoSplit">';
        echo '<div class="infoD"><p class="infoLabel"><img id="skillicon" class="infoIconClass" src="/mainImage/skillicon.png">전문기술</p><div id="specialtyInfo" class="infoDetail">';
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
        foreach($GLOBALS['MyGroups'] as $MyGroup){
          echo '<div class = "myGroup">
            <p class = "infoLabel"><img class = "infoIconClass" src = "/mainImage/group.png">소속 그룹</img></p><a href = "/anotherProfile?int='.$MyGroup->groupPK.'"><p class = "infoDetail">'.$MyGroup->Name.'</p></a>
          </div>'
          ;
        }

      } // if PERSON end

      if($GLOBALS['isGroup']=="1"){ //그룹일 시
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
          echo '<hr id="infoSplit">
          <div class="infoD"><p class="infoLabel"><img id="awardicon" class="infoIconClass" src="/mainImage/awardicon.png">Awards</p><div id="awardInfo" class="infoDetail">';
            $i = 0;
            foreach ($GLOBALS['awardArr'] as $temp) {
              echo '<p id="award'.$i.'" class="award">'.$temp.'</p>';
              $i++;
        # code...
            }
          echo'</div></div>'; //Awards end

          echo'<hr id="infoSplit">
          <div class="infoD"><p class="infoLabel"><img id="workicon" class="infoIconClass" src="/mainImage/workicon.png">그룹소개</p><p class="infoDetail">'.$GLOBALS['description'].'</p></div>';
          echo '</div>';
        }// if GROUP end
        echo '</div></div>';  //lowerInfo division end
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
