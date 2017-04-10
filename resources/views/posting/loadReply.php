<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

//댓글을 띄워주는데 답변이 완료된 댓글은 여기 띄워주지 않는다.


class loadReplyClass extends Controller
{
    public $Replies;
    function __construct($artPK) // 생성자 선언
    {
          $this->Replies = DB::select("select * from Question as A inner join userinfo as B on A.askeruserPK = B.userPK and A.artPK = ? order by QuestionPK DESC",[$artPK]);
    }
    function loadReply($artPK)
    {

      $Sentence = "select userPK from workDB where artPK = ".$artPK;
      $users = DB::select(DB::raw($Sentence));
      $checkInfo = false;
      foreach($users as $user){
          if($user->userPK == $_SESSION['userPK']){
            $checkInfo = true;
          }
      }

      foreach($this->Replies as $Reply){
        echo '
        <div id="Qcard" class="Qcard">
          <img id="Qpics" src='.$Reply->ProfilePhotoURL.'>
          <p id="Qs" class="Qs">'.$Reply->Question.'</p>';
          if($checkInfo){
              echo '<button id="answerBt'.$Reply->QuestionPK.'">▶</button>';
          }else if($Reply->userPK == $_SESSION['userPK'])
          {
              echo '<button id="deleteBt'.$Reply->QuestionPK.'">▶</button>';
          }
        echo '</div>';
      }
    }
}

?>
