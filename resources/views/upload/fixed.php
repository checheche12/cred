<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class makeNewArtClass extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function textInfo()
      {
        $Sentence = "select ArtURL, title, description from totalart where artPK = ".$_GET['int'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $GLOBALS['URL'] = $user->ArtURL;
          $GLOBALS['title'] = $user->title;
          $GLOBALS['description'] = $user->description;
        }

        $Sentence = 'select A.userPK,Name,Position from workDB as A join userinfo as B where artPK = '.$_GET['int'].' and A.userPK = B.userPK';
        $users = DB::select(DB::raw($Sentence));

        $GLOBALS['userData'] = array();

        foreach($users as $user){
          $imshi = array();
          array_push($imshi,$user->userPK);
          array_push($imshi,$user->Name);
          array_push($imshi,$user->Position);
          array_push($GLOBALS['userData'],$imshi);
        }

        $Sentence = 'select tagPK, tagUser, position from TagNotUser where ArtPK = '.$_GET['int'];
        $users = DB::select(DB::raw($Sentence));

        $GLOBALS['notUserData'] = array();
        foreach($users as $user){
          $imshi = array();
          array_push($imshi,$user->tagPK);
          array_push($imshi,$user->tagUser);
          array_push($imshi,$user->position);
          array_push($GLOBALS['notUserData'],$imshi);
        }
      }
    }

    $A = new makeNewArtClass();
    $A->textInfo();
    ?>
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <link rel="stylesheet" type ="text/css" href="css/upload.css">

    <div id = "header">
      <?php
      include_once('../resources/views/header.php');
      ?>
    </div>

    <p id = "uploadtext" >UPLOAD</p>
    <div id="uploadSheet">
      <div id = "video">

      </div>

      <div id = "contextBox">

        <label for="URLBox">URL을 입력하여 프로젝트를 업로드하세요</label><br>
        <input id = "URLBox" type="text" value = <?php echo $GLOBALS['URL'] ?> ></input><br><br>
        <label for="titleBox">제목</label><br>
        <textarea id = "titleBox"><?php echo $GLOBALS['title'] ?></textarea><br><br>

        <div><label for="email">크레딧</label>
          <p class="help">작품제작에 참여한 모든 이들이 주인공입니다.<br>영상 제작에 기여한 모든 사람들을 크레딧에 달아주세요.</p>
        </div>

        <div id="email-menu-container"></div>
        <div id="position-menu-container"></div>

        <input id = "email" type="text" placeholder="이름 / e-mail"></input>
        <input id = "position" type="text" placeholder="포지션 (ex.촬영, 기획, 클라이언트, 협력사, ...)"></input>
        <button id = "submitCredit" >+추가</button><br><br>
        <!-- 추가된 크레딧 -->

        <div id = "emailsuggest">

        </div>

        <div id = "creditBox">
          <p id="creditTitle">Credit</p>
          <script>
            var creditArray = [];
            var NotUserCreditArray = [];
            var NotUserCreditNumber = 0;
          </script>
          <?php
          foreach($GLOBALS['userData'] as $i){
            echo "<div class = 'creditContext'>";
            echo "<div class='position'>".$i[2]."</div>";
            echo "<div class='name'>".$i[1]."</div>";
            echo "<a class = 'xImage' id = ".$i[0]."></a></div>";
            echo "<script>";
            echo "var t = [".$i[0].",'".$i[2]."']; creditArray.push(t);";
            echo "</script>";
          }
          $NotUserCreditNumber = 0;
          foreach($GLOBALS['notUserData'] as $i){
            echo "<div class = 'creditContext'>";
            $NotUserCreditNumber +=1;
            echo "<div class='position'>".$i[2]."</div>";
            echo "<div class='name'>".$i[1]."</div>";
            echo "<img class = 'xImage' id = ".$NotUserCreditNumber." src ='/mainImage/uploadImage/x.jpg'></img></div>";
            echo "<script>";
            echo "var t = ['".$i[1]."', '".$i[2]."', NotUserCreditNumber]; NotUserCreditArray.push(t); NotUserCreditNumber++";
            echo "</script>";
          }
          ?>
        </div>

        <label for="context">작품설명</label><br>
        <p class="help">작품과 작품 제작과정에 대한 모든 정보를 공유해 주세요.<br>
          사람들은 주로 비디오 저작권자, 기획 인사이트, 사용된 촬영 및 편집 기술과 장비, 음향소스 같은 정보를 궁금해합니다.</p>
          <textarea id = "context" cols : "40" rows:"10" placeholder="[TIP] 작품과 작품 제작과정에 대한 모든 정보를 공유해 주세요.
          사람들은 주로 비디오 저작권자, 기획 인사이트, 사용된 촬영 및 편집 기술과 장비, 음향소스 같은 정보를 궁금해합니다."><?php echo str_replace("<br>", "\r\n",  $GLOBALS['description']); ?></textarea><br><br>

          <button id = "deleteButton" class="submitButton">작품 삭제</button>
          <button id = "cancelButton" class="submitButton">취소</button>
          <button id = "saveButton" class="submitButton">수정</button>

        </div>
      </div>
      <script>
        artPK = <?= $_GET['int']?>;
      </script>
      <script type = "text/javascript" src = "js/fixed.js"></script>
