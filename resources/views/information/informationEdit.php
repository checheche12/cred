<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

class UserController extends Controller
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
        }
        $Sentence = "select * from keywordDB where userPK = ".$_SESSION['userPK'];

        $users2 = DB::select(DB::raw($Sentence));
        $GLOBALS['keyword'] = "";
        foreach($users2 as $usera){
          $a=$usera->keyword;
          $GLOBALS['keyword'].=$a.',';
        }
        $GLOBALS['keyword'] = substr($GLOBALS['keyword'],0,-1);
      }
    }

    $A = new UserController();
    $A->getUserData();

    ?>

    <?php
    if(!isset($_SESSION['is_login'])){
      header('Location: ./');
      exit;
    }
    ?>
    <link rel="stylesheet" type ="text/css" href="css/informationEdit.css">

    <div id = "header">

    </div>

    <div id = "uploadContent">

      <div id="pImageFrame">

        <div id = "pImage"><img id='profileImagePreview' src='<?= $GLOBALS['ProfilePhotoURL']?>'></div><br>

        <div id = "uploadSource">
          <label for="ProfilePhotoURL">프로파일 사진 URL</label><br>
          <input class="inputs" type = "text" id = "ProfilePhotoURL" value = "<?= $GLOBALS['ProfilePhotoURL']?>"></input>
        </div>
      </div>
      <div id="nameD">
        <div class="labelsD"><label class="labels" for="name">이름</label></div><input class="inputs" type = "text" id = "name" value = "<?= $GLOBALS['name']?>"></input>
      </div><br>
      <div id="educationD">
        <div id="schoolD">
          <div class="labelsD"><label class="labels" for="education">학력</label></div><input class="inputs" type = "text" id = "education" value = "<?= $GLOBALS['education']?>"></input>
          <div id="graduateYearD">
            <div class="labelsD"><label class="labels" for="education">졸업(예정)</label></div><input class="inputs" type = "number" min="1900" max="2030" id = "education" placeholder="YYYY" value = "<?= $GLOBALS['education']?>"></input>
          </div>
        </div>
      </div><br>
      <div id="company">
        <div id="current_organizationD">
          <div class="labelsD"><label class="labels" for="">현 소속</label></div><input class="inputs" type = "text" id = "current_organization" value = "<?= $GLOBALS['name']?>"></input>
        </div><br>
        <div id="current_positionD">
          <div class="labelsD"><label class="labels" for="">현 직책</label></div><input class="inputs" type = "text" id = "current_position" value = "<?= $GLOBALS['name']?>"></input>
        </div>
      </div><br>
      <div id="locationD">
        <div class="labelsD"><label class="labels" for="location">위치</label></div><input class="inputs" type = "text" id = "location" value = "<?= $GLOBALS['name']?>"></input>
      </div><br>
      <div id="keywordD">
        <div class="labelsD"><label class="labels" for="keyword">전문기술</label></div><textarea rows="3" id = "keyword" cols="30" name="contents"><?= $GLOBALS['keyword']?></textarea>
      </div><br>
      <div id="experienceD">
        <div id="labelEx"><label class="labels">경력</label></div>
        <div id="companyEx">
          <div id="positionD">
            <div class="labelsD"><label class="labels" for="position">직함</label></div><input class="inputs" type = "text" id = "position" value = "<?= $GLOBALS['career']?>"></input>
          </div>
          <div id="organizationD">
            <div class="labelsD"><label class="labels" for="origanzation">소속</label></div><input class="inputs" type = "text" id = "origanzation" value = "<?= $GLOBALS['career']?>"></input><br>
          </div>
        </div>
        <br>
        <div id="workPeriodD">
          <div id="labelEx"><label class="labels">근무기간</label></div>
        </div>
        <div id="start">
          <div class="labelsD"><label class="labels">시작</label></div><br>
          <div class="start_year">
            <div class="labelsD"><label for="start_year">연도(YYYY)</label></div><input class="inputs" type="number" min="1900" max="2030" value = "<?= $GLOBALS['career']?>" id = "start_year" placeholder="YYYY"></input>
          </div>
          <div class="start_month">
            <div class="labelsD"><label for="start_month">월(MM)</label></div><input class="inputs" type="number" min="1" max="12" id = "start_month" value = "<?= $GLOBALS['career']?>" placeholder="MM"></input>
          </div>
        </div><br>
        <div id="end">
        <div class="labelsD"><label class="labels">종료</label></div><br>
          <div class="end_year">
            <div class="labelsD"><label for="end_year">연도(YYYY)</label></div><input class="inputs" type="number" min="1900" max="2030" value = "<?= $GLOBALS['career']?>" id = "end_year" placeholder="YYYY"></input>
          </div>
          <div class="end_month">
            <div class="labelsD"><label for="end_month">월(MM)</label></div><input class="inputs" type="number" min="1" max="12" id = "end_month" value = "<?= $GLOBALS['career']?>" placeholder="MM"></input><br>
          </div>
        </div>
        <div id="descriptionD">
          <div class="labelsD"><label class="labels" for="">설명</label></div><input class="inputs" type = "text" id = "career" value = "<?= $GLOBALS['career']?>" id = "career"></input><br>
        </div>
      </div>
      <div id="editBox">
        <button id="addExperience">+추가</button><br>
      </div>
      <button id="edit">수정</button>
    </div>

    <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
    <script type = "text/javascript" src = "js/informationEdit.js"></script>
