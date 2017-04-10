<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UploadReplyClass extends Controller
{
    function UploadReply()
    {
       $UploadReplys = DB::insert("insert into QuestionReply (QuestionPK,ReplyuserPK,Reply,uploaddate) values (?,?,?,?)",[$_POST['QuestionPK'],$_SESSION['userPK'],$_POST['ReplyReply'],date("Y-m-d H:i:s")]);
       $upload = DB::update("update Question set Replied = true where QuestionPK = ?",[$_POST['QuestionPK']]);

    }

}

$A = new UploadReplyClass();
$A->UploadReply();

?>
