
<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        $Sentence2 = "select * from userExperience where userPK = ".$_SESSION['userPK'];
        $users2 = DB::select(DB::raw($Sentence2));
        $GLOBALS['exOrganization'] = "";
        $GLOBALS['exPosition'] = "";
        $GLOBALS['StartDate'] = "";
        $GLOBALS['EndDate'] = "";
        $GLOBALS['exWorkLocation'] = "";
        $GLOBALS['Explainn'] = "";
        foreach($users2 as $user){
          $GLOBALS['exOrganization'] = $user->Organization;
          $GLOBALS['exPosition'] = $user->Position;
          $GLOBALS['StartDate'] = $user->StartDate;
          $GLOBALS['EndDate'] = $user->EndDate;
          $GLOBALS['exWorkLocation'] = $user->WorkLocation;
          $GLOBALS['Explainn'] = $user->Explainn;
        }
      }
    }

    $A = new UserController();
    $A->getUserData();

    ?>

    <link rel="stylesheet" type ="text/css" href="css/informationEdit.css">
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <div id = "header">

</div>

<div id = "uploadContent">
  <div id="infoSheet">

    <div id = "pImage">
      <img id='profileImagePreview' src='<?= $GLOBALS['ProfilePhotoURL']?>'>
    </div>
    <br>
    <div id="ProfilePhotoURLD">
      <label class="labels" for="ProfilePhotoURL">프로파일 사진 URL</label>
      <input class="inputs" type = "text" id = "ProfilePhotoURL" value = "<?= $GLOBALS['ProfilePhotoURL']?>"></input>
    </div>
    <div id="nameD">
      <div><label class="labels" for="name">이름</label>
        <input class="inputs" type = "text" id = "name" value = "<?= $GLOBALS['name']?>"></input>
      </div>
    </div><br>
    <!-- <div id="educationD"> -->
    <div><label class="labels" for="education">학력</label>
      <input class="inputs" type = "text" id = "education" value = "<?= $GLOBALS['education']?>"></input><br>
    </div>
    <!-- <label class="labels" for="education">졸업(예정)</label><br> -->
    <!-- <input class="inputs" type = "number" min="1900" max="2030" id = "education2" placeholder="YYYY" value = "<?= $GLOBALS['education2']?>"></input> -->
    <!-- </div><br> -->
    <div><label class="labels" for="">현 소속</label>
      <input class="inputs" type = "text" id = "current_organization" value = "<?= $GLOBALS['current_organization']?>"></input>
    </div>
    <br>
    <div><label class="labels" for="">현 직책</label>
      <input class="inputs" type = "text" id = "current_position" value = "<?= $GLOBALS['career']?>"></input>
    </div>
    <br>
    <div id="locationD">
      <div><label class="labels" for="location">위치</label>
        <input class="inputs" type = "text" id = "location" value = "<?= $GLOBALS['location']?>"></input>
      </div>
    </div><br>
    <div id="keywordD">
      <div><label class="labels" for="keyword">전문기술</label>
        <textarea rows="3" id = "keyword" cols="30" name="contents"><?= $GLOBALS['keyword']?></textarea>
      </div>
    </div><br>
    <label class="labels" id="career">경력</label>

    <div id="careerGroupD">

      <div id="careerD">
        <div id="positionD">
          <div><label class="labels" for="position" id="positionlabel">직함</label>
            <input class="inputs" type = "text" id = "position" value = "<?= $GLOBALS['exPosition']?>"></input>
          </div>
        </div>
        <div id="organizationD">
          <div><label class="labels" for="organization" id="organizationlabel">소속</label>
            <input class="inputs" type = "text" id = "organization" value = "<?= $GLOBALS['exOrganization']?>"></input><br>
          </div>
        </div>
        <div id="organizationD">
          <div><label class="labels" for="exWorkLocation" id="locationlabel">위치</label>
            <input class="inputs" type = "text" id = "exWorkLocation" value = "<?= $GLOBALS['exWorkLocation']?>"></input>
          </div>
        </div>
        <div id="descriptionD">
          <div><label class="labels" for="career" id="descriptionlabel">설명</label>
            <input class="inputs" type = "text" id = "career" value = "<?= $GLOBALS['Explainn']?>" id = "career"></input><br>
          </div>
        </div>
      </div>

      <div id="addExperienceD">
        <button id="addExperience">+추가</button><br>
      </div>
    </div>
    <div id="editD">
      <button id="edit">수정</button>
    </div>
  </div>
</div>
    <?php
    if($_SESSION['persongroup'] == "group")
      echo "<div id = 'desdescription'>";
    echo '<div><label class="labels" for="keyword">그룹 설명</label></div><textarea rows="3" id = "desdescription" cols="30" name="contents">'.$GLOBALS['description'].'</textarea>';
    echo "</div>";
    ?>

    <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type = "text/javascript" src = "js/informationEdit.js"></script>
