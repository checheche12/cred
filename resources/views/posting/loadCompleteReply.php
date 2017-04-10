<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

//댓글을 띄워주는데 답변이 완료된 댓글은 여기 띄워주지 않는다.


class loadCompleteReplyClass extends Controller
{
   function loadCompleteReply($artPK)
   {
      $loadCompleteReplies = DB::select("select B.ProfilePhotoURL as askerPhotoURL, Question, Reply, D.ProfilePhotoURL as ReplierPhotoURL from Question
      as A join userinfo as B join QuestionReply as C join userinfo as D where A.askeruserPK = B.userPK
      and C.ReplyuserPK = D.userPK and C.QuestionPK = A.QuestionPK and ArtPK = ? and Replied = ?",[$artPK,true]);
      // A와B 는 Question 에 관련한 DB 이고 B는 Question 한 사람의 정보를 가지고 온다
      // 반면 C와 D는  Reply 에 관련한 DB이고 D 는 Reply 를 단 사람의 정보를 가지고 온다.
      if(count($loadCompleteReplies)==0){
        echo '
        <img id="noAnswerImg" src="">
        <p id="noAnswerP">아직 답변된 질문이 없습니다.</p>';
      }else{
        foreach($loadCompleteReplies as $loadCompleteReply){

          echo '
          <div id="Qcard" class="Qcard">
            <img id="Qpics" src='.$loadCompleteReply->askerPhotoURL.'>
            <p id="Qs" class="Qs">'.$loadCompleteReply->Question.'</p>
            </div>';
            echo '달린 댓글입니다.';
            echo '
            <div id="Qcard" class="Qcard">
              <img id="Qpics" src='.$loadCompleteReply->ReplierPhotoURL.'>
              <p id="Qs" class="Qs">'.$loadCompleteReply->Reply.'</p>
              </div>';
            echo '---------------------------------------------';

        }
      }
   }
}

?>
