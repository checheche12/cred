<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

//댓글을 띄워주는데 답변이 완료된 댓글은 여기 띄워주지 않는다.


class loadCompleteReplyClass extends Controller
{
 function loadCompleteReply($artPK)
 {
  $loadCompleteReplies = DB::select("select A.askeruserPK as QuserPK, C.ReplyuserPK as RuserPK, B.ProfilePhotoURL as askerPhotoURL, Question,
   B.Name as askerName, A.uploaddate as askeruploaddate,
   Reply, D.ProfilePhotoURL as ReplierPhotoURL, D.Name as ReplyName, C.uploaddate as Replyuploaddate from Question
   as A join userinfo as B join QuestionReply as C join userinfo as D where A.askeruserPK = B.userPK
   and C.ReplyuserPK = D.userPK and C.QuestionPK = A.QuestionPK and ArtPK = ? and Replied = ?",[$artPK,true]);
      // A와B 는 Question 에 관련한 DB 이고 B는 Question 한 사람의 정보를 가지고 온다
      // 반면 C와 D는  Reply 에 관련한 DB이고 D 는 Reply 를 단 사람의 정보를 가지고 온다.
  if(count($loadCompleteReplies)==0){
    echo '<p class="answerStatus">아직 답변된 질문이 없습니다.</p>';
  }else{
    echo '<p class="answerStatus">답변된 질문</p>';
    foreach($loadCompleteReplies as $loadCompleteReply){

      echo '
      <div class="QnACard">
        <div id="Qcard" class="Qcard">
          <div class="personalQnAstatus">
            <div class="personalInfo">
              <a href = "/anotherProfile?int='.$loadCompleteReply->QuserPK.'"><img id="Qpics'.$loadCompleteReply->QuserPK.'" class="Qpics" src='.$loadCompleteReply->askerPhotoURL.'></a>
              <a href = "/anotherProfile?int='.$loadCompleteReply->QuserPK.'"><p id = "name'.$loadCompleteReply->QuserPK.'" class = "name">'.$loadCompleteReply->askerName.'</p></a>
            </div>
            <p class="qnaLabel">Q</p>
          </div>
          <p id="QsComplete" class="QsComplete">'.$loadCompleteReply->Question.'</p>
          <p id ="uploaddate" class = "uploaddate">'.$loadCompleteReply->askeruploaddate.'</p>
        </div>';
        echo '
        <div id="Qcard" class="Qcard">
          <div class="personalQnAstatus">
            <div class="personalInfo">
              <a href = "/anotherProfile?int='.$loadCompleteReply->RuserPK.'"><img id="Qpics'.$loadCompleteReply->RuserPK.'" class="Qpics" src='.$loadCompleteReply->ReplierPhotoURL.'></a>
              <a href = "/anotherProfile?int='.$loadCompleteReply->RuserPK.'"><p id = "name'.$loadCompleteReply->RuserPK.'" class = "name">'.$loadCompleteReply->ReplyName.'</p></a>
            </div>
            <p class="qnaLabel">A</p>
          </div>
          <p id="QsComplete" class="QsComplete">'.$loadCompleteReply->Reply.'</p>
          <p id ="uploaddate" class = "uploaddate">'.$loadCompleteReply->Replyuploaddate.'</p>
        </div>
      </div>';
    }
  }
}
}

?>
