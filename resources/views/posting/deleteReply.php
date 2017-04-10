<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UploadReplyClass extends Controller
{
    function UploadReply()
    {
        $getuserPK = DB::select("select askeruserPK,artPK from Question where QuestionPK = ?",[$_POST['QuestionPK']]);
        foreach($getuserPK as $kkk){
          $GLOBALS['artPK'] = $kkk->artPK;
          $GLOBALS['askeruserPK'] = $kkk->askeruserPK;
          break;
        }

        $auth = false;
        $trueorfalse = false;

        $getworkDBLists = DB::select("select userPK from workDB where artPK = ?",[$GLOBALS['artPK']]);
        foreach($getworkDBLists as $getworkDBList){
          if($getworkDBList->userPK == $_SESSION['userPK']){
            $trueorfalse = true;
            break;
          }
        }

        if($GLOBALS['askeruserPK']==$_SESSION['userPK']){
            $auth = true;
        }else if($trueorfalse){
          $auth = true;
        }

        if($auth){
            $a = DB::delete("delete from Question where QuestionPK = ?",[$_POST['QuestionPK']]);
        }

    }

}

$A = new UploadReplyClass();
$A->UploadReply();

?>
