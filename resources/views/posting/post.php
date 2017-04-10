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
      public function index()
      {
        $Sentence = "select * from totalart where artPK = ".$_GET['int'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $GLOBALS['Title'] = $user->title;
          $GLOBALS['ARTURL'] = $user->ArtURL;
          $GLOBALS['uploadDate'] = $user->uploaddate;
          $GLOBALS['lastloadDate'] = $user->lastloaddate;
          $GLOBALS['Description'] = $user->description;
          $GLOBALS['uploader'] = $user->uploader;
          $GLOBALS['uploaderName'] = $user->uploaderName;
          $GLOBALS['views'] = $user->views;
        }
      }

      public function getWorkNameList(){
        $Sentence2 = "select A.userPK, Name from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        $a = 1;
        foreach($users2 as $user){
          echo "<p class = 'name' id = ".$user->userPK.">".$user->Name."</p>";
          $a+=1;
        }
        $Sentence2 = "select tagUser from TagNotUser where artPK =".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'nameNoAccount'>".$user->tagUser."</p>";
        }
      }

      public function getWorkPositionList(){
        $Sentence2 = "select position from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'position'>".$user->position."</p>";
        }
        $Sentence2 = "select position from TagNotUser where artPK =".$_GET['int'];
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          echo "<p class = 'positionNoAccount'>".$user->position."</p>";
        }
      }

      public function getUserCreditList(){
        $Sentence2 = "select B.userPK from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$_GET['int'];
        $GLOBALS['userPKArray'] = array();
        $users2 = DB::select(DB::raw($Sentence2));
        foreach($users2 as $user){
          array_push($GLOBALS['userPKArray'],$user->userPK);
        }
      }
      public function countViews(){
        $Sentence = "update totalart set views = views + 1 where artPK = '".$_GET['int']."'";
        $users = DB::update(DB::raw($Sentence));
      }
    }
    $A = new UserController();
    $A->countViews(); //조회수 때문에 index 앞에 위치함
    $A->index();

?>

    <head>
      <style type="text/css">
        .noJs {display: none;}
        /*#pfpf{display: none;}*/
        /*#header{display: none;}*/
      </style>
      <script type="text/javascript">
        document.documentElement.className = 'noJs';
      </script>
    </head>
    <link rel="icon" type="image/png" href="/mainImage/webicon_16x16.png" sizes="16x16" />
    <link rel="stylesheet" type ="text/css" href="css/main.css">
    <link rel="stylesheet" type ="text/css" href="css/post.css">

    <div id ='header'>

    </div>
    <!-- <div><button id="close">X</button></div>


        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
      -->

      <div id = "ContentMain">
        <div id = "LeftCont">
          <div class="outCreditFrame">
            <div class="creditFrame">
              <p class="creditLabel">Credit</p>
              <div class="positionFrame" id="positionFrame">
                <?php
                $A->getWorkPositionList();
                ?>
              </div>
              <div class="nameFrame" id="nameFrame">
                <?php
                $A->getWorkNameList();
                ?>
              </div>
            </div>
          </div> <!-- outCreditFrame end -->
          <div id="officialInfo">
            <div id = "officialDesc">
              <p id="workTitle"><!-- AKMU - How People Move --><?php echo $GLOBALS['Title'];?></p>
              <div id="postInfo">
                <p id="postDateLabel" class="postInfo">게시일:&nbsp;</p>
                <p id="postDate" class="postInfo">
                  <?php $t = strtotime($GLOBALS['uploadDate']);
                  echo date('Y/m/d',$t);?>
                </p>
                <p id="postWriterLabel" class="postInfo">작성자:&nbsp;</p>
                <p id="postWriter" class="postInfo"><?= $GLOBALS['uploaderName'] ?></p>
              </div>
              <div id="viewD">
                <p id="viewLabel" class="view">조회수&nbsp;</p>
                <p id="viewNum" class="view"><?php echo number_format($GLOBALS['views'],0,"",",");?></p>
              </div>
              <div id="descriptionFrame">
                <p id="description"><!-- AKMU | #AKMU #악뮤 #악동뮤지션 #사움직 #사춘기 #악뮤사춘기 #思春記 #上권 #COMEBACK #ONLINE0504 #0AM #OFFLINE0509 @akmu_suhyun @akmuchanhk --><?= $GLOBALS['Description']?></p></div>
              </div>
              <hr id="splitter">
              <div id="officialAnswers">
                <div id="noAnswer">
                  <img id="noAnswerImg" src="http://dxlfb468n8ekd.cloudfront.net/gsc/P9T9E7/f2/0f/ab/f20fab8c10cd41579e7b9b999babf893/images/post_page3/u16.png?token=1ecd817523b2c668d3ecd2689a1d833b">
                  <p id="noAnswerP">아직 답변된 질문이 없습니다.</p>
                </div>
              </div>
            </div>
            <div id="unofficialOfficialInfo">
              <div id="UOIbtFrame">
                <button id="helpUOI">설명</button>
                <button id="editUOIBt">[편집]</button>
              </div>
              <div id="noUOI">
                <img id="noUOIImg" src="http://dxlfb468n8ekd.cloudfront.net/gsc/P9T9E7/f2/0f/ab/f20fab8c10cd41579e7b9b999babf893/images/post_page3/u16.png?token=1ecd817523b2c668d3ecd2689a1d833b">
                <p id="noUOIP">아직 작성된 답변이 없습니다.</p>
              </div>
            </div>

          </div>  <!-- LeftCont end -->

          <div id = "RightCont">
            <div id="workFrame">
              <!-- <iframe src="https://player.vimeo.com/video/176567696" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
            </div>
            <div id="QFrame">
              <div id="QCountFrame">
                <p id="QCount">질문 -&nbsp;</p>
                <?php
                    include_once('../resources/views/posting/loadReply.php');
                    $LoadReply = new loadReplyClass($_GET['int']);
                ?>
                <p id="QNum"><?=count($LoadReply->Replies);?></p>
              </div>

              <div id="submitFrame">
                <?php
                    if($_SESSION['is_login'] == true){
                      echo '
                      <div id="QInputFrame">
                      <input id="QInput" type="text" name="Q" placeholder="제작자들에게 직접 질문해 보세요.">
                      </div>
                      <button id="askBt">등록</button>
                      ';
                    }
                ?>

              </div>
              <div id="QListFrame">
                  <?php
                        $LoadReply->loadReply($_GET['int']);
                   ?>
              </div>
            </div>

          </div>  <!-- RightCont end -->


          <!--수정, 삭제 버튼이 여기서 달려있게 된다.-->
          <div>
            <?php
            $A->getUserCreditList();
            foreach($GLOBALS['userPKArray'] as $user){
              if($user == $_SESSION['userPK']){
                echo '<button id="fixed">수정</button>';
                echo '<button id="delete">삭제</button>';
                break;
              }
            }
            ?>
          </div>

        </div>

        <script>
          var ArtPK =<?=$_GET['int']?>;
          var userPKArr = new Array("<?=implode("\",\"" , $GLOBALS['userPKArray']);?>");
          var SourceURL = "<?= $GLOBALS['ARTURL'] ?>";
        </script>

        <script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type = "text/javascript" src = "js/post.js"></script>
   <script type="text/javascript">//FOUC(Flash Of Unstyled Content) 방지 용
    $(function(){
      $('.noJs').css('display','block');
    });
  </script>
