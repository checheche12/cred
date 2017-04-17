<?php
class UserController
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function getUserData()
      {
        $Sentence = "select * from userinfo where userPK = ".$_SESSION['userPK'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $GLOBALS['name'] = $user->Name;
          $GLOBALS['career'] = $user->Career;
          $GLOBALS['education'] = $user->education;
          $GLOBALS['ProfilePhotoURL'] = $user->ProfilePhotoURL;

          $GLOBALS['current_organization'] = $user->belong;
          $GLOBALS['location'] = $user->location;
          $GLOBALS['education2'] = $user->graduateDate;
          $GLOBALS['description'] = $user->description;

        }
        $Sentence = "select * from keywordDB where userPK = ".$_SESSION['userPK'];
        $users2 = DB::select(DB::raw($Sentence));
        $GLOBALS['keyword'] = "";
        foreach($users2 as $usera){
          $a=$usera->keyword;
          $GLOBALS['keyword'].=$a.',';
        }
        $GLOBALS['keyword'] = substr($GLOBALS['keyword'],0,-1);


        $Sentence = "select * from awardDB where userPK = ".$_SESSION['userPK'];
        $users2 = DB::select(DB::raw($Sentence));
        $GLOBALS['award'] = "";
        foreach($users2 as $usera){
          $a=$usera->award;
          $GLOBALS['award'].=$a.',';
        }
        $GLOBALS['award'] = substr($GLOBALS['award'],0,-1);


        $Sentence2 = "select * from userExperience where userPK = ".$_SESSION['userPK'];
        $users2 = DB::select(DB::raw($Sentence2));
        $GLOBALS['exOrganization'] = array();
        $GLOBALS['exPosition'] = array();
        $GLOBALS['StartDate'] = array();
        $GLOBALS['EndDate'] = array();
        $GLOBALS['exWorkLocation'] = array();
        $GLOBALS['Explainn'] = array();
        foreach($users2 as $user){
          array_push($GLOBALS['exOrganization'],$user->Organization);
          array_push($GLOBALS['exPosition'],$user->Position);
          array_push($GLOBALS['StartDate'],$user->StartDate);
          array_push($GLOBALS['EndDate'],$user->EndDate);
          array_push($GLOBALS['exWorkLocation'],$user->WorkLocation);
          array_push($GLOBALS['Explainn'],$user->Explainn);
        }
      }
    }

    $A = new UserController();
    $A->getUserData();

    ?>

    <link rel="stylesheet" type ="text/css" href="css/informationEdit.css">
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <div id = "header">
      <?php
      include_once('../resources/views/header.php');
      ?>
    </div>

    <div id = "uploadContent">
      <div id="infoSheet">
        <div id="guideFrame">
          <img id="guidePImage" src="/mainImage/credqmark.png"><br>
          <p class="guideP">프로필을 더 자세하게 작성해주세요.</p><br><br>
          <p class="guideP">자신의 정보를&nbsp;</p><p class="guideP emphasize">공개할수록</p><br><p class="guideP">다른 사람들과</p> <p class="guideP emphasize">연결되기가</p> <p class="guideP"> 더 쉽습니다.</p>

        </div>

        <div id = "pImage">
          <img id='profileImagePreview' src='<?= $GLOBALS['ProfilePhotoURL']?>'>
        </div>
        <br>
        <div id="ProfilePhotoURLD">
          <label id = "ProfilePhotoLabel"class="labels" for="ProfilePhotoURL">프로파일 사진 업로드</label>
          <input type = "file" id = "ProfilePhotoURL"></input>
        </div>
        <div id="buttonFrame">
          <button id = "submitprofilePic">프로필 사진 적용</button>
        </div>
        <div id="nameD">
          <div><label class="labels" for="name">이름</label>
            <input class="inputs" type = "text" id = "name" value = "<?= $GLOBALS['name']?>"></input>
          </div>
        </div>
        <!-- <div id="educationD"> -->
        <?php
        if($_SESSION['isGroup']!="Group"){
          echo '<div><label class="labels" for="education">학교</label>
          <input class="inputs" type = "text" id = "education" value = "'.$GLOBALS['education'].'"></input><br>
        </div>
        <div><label class="labels" for="">현 소속</label>
          <input class="inputs" type = "text" id = "current_organization" value = "'.$GLOBALS['current_organization'].'"></input>
        </div>
        <div><label class="labels" for="">현 직책</label>
          <input class="inputs" type = "text" id = "current_position" value = "'.$GLOBALS['career'].'"></input>
        </div>
        <div id="locationD">
          <div><label class="labels" for="location">위치</label>
            <input class="inputs" type = "text" id = "location" value = "'.$GLOBALS['location'].'"></input>
          </div>
        </div><br>
        <div id="keywordD">
          <div><label id="keywordLabel" class="labels" for="keyword">전문기술</label>
            <textarea rows="3" id = "keyword" cols="30" name="contents" placeholder="각 기술들을 &comma; 로 나누어 작성해 주세요.">'.$GLOBALS['keyword'].'</textarea>
          </div>
        </div><br>
        <label class="labels" id="career">경력</label>
        <hr class="splitter">

        <div id="careerGroupD">';
          for ($i=0; $i < count($GLOBALS['exOrganization']) ; $i++) {
  # code...
            echo'
            <div id="careerD">
              <div id="positionD">
                <div><label class="labels2" for="position" id="positionlabel">직함</label>
                  <input class="inputsexp" type = "text" id = "position" value = "'.$GLOBALS['exPosition'][$i].'"></input>
                </div>
              </div>
              <div id="organizationD">
                <div><label class="labels2" for="organization" id="organizationlabel">소속</label>
                  <input class="inputsexp" type = "text" id = "organization" value = "'.$GLOBALS['exOrganization'][$i].'"></input><br>
                </div>
              </div>
              <div id="organizationD">
                <div><label class="labels2" for="exWorkLocation" id="locationlabel">위치</label>
                  <input class="inputsexp" type = "text" id = "exWorkLocation" value = "'.$GLOBALS['exWorkLocation'][$i].'"></input>
                </div>
              </div>
              <div id="descriptionD">
                <div><label class="labels2" for="career" id="descriptionlabel">설명</label>
                  <input class="inputsexp" type = "text" id = "career" value = "'.$GLOBALS['Explainn'][$i].'" id = "career"></input><br>
                </div>
              </div>
            </div>';
          }

          echo '</div>
          <div class="spacer">&nbsp</div>
          <hr id="sp2" class="splitter">
          <div id="addExperienceD">
            <button id="addExperience">+추가</button><br>
          </div>';
        }?> <!-- if PERSON -->
        <?php
        if($_SESSION['isGroup']=="Group"){
          echo'<div id="locationD">
          <div><label class="labels" for="location">위치</label>
            <input class="inputs" type = "text" id = "location" value = "'.$GLOBALS['location'].'"></input>
          </div>
        </div><br>
        <div id="keywordD">
          <div><label class="labels" for="keyword">키워드</label>
            <textarea rows="3" id = "keyword" cols="30" name="contents" placeholder="각 키워드들을 &comma; 로 나누어 작성해 주세요.">'.$GLOBALS['keyword'].'</textarea>
          </div>
        </div><br>
        <div id="awardD">
          <div><label class="labels" for="award">수상경력</label>
            <textarea rows="3" id = "award" cols="30" name="contents" placeholder="각 수상경력들을 &comma; 로 나누어 작성해 주세요.">'.$GLOBALS['award'].'</textarea>
          </div>
        </div><br>
        <div id = "desdescription">
          <div><label class="labels" for="description">그룹 설명</label><textarea rows="3" id = "description" cols="30" name="contents">'.$GLOBALS['description'].'</textarea>
          </div>
        </div>';
      }
      ?>
      <div id="editD">
        <button id="edit">수정</button>
      </div>
    </div>
  </div>

  <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type = "text/javascript" src = "js/informationEdit.js"></script>
