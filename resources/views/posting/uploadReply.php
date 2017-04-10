<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UploadReplyClass extends Controller
{
    function UploadReply()
    {
        $a = DB::insert("insert into Question (ArtPK,askeruserPK,Question, uploaddate, expiredate) values (?,?,?,?,?)",[$_POST['artPK'],$_SESSION['userPK'],$_POST['Description'],date("Y-m-d H:i:s"),date("Y-m-d H:i:s",strtotime("+14 day"))]);
    }

}

$A = new UploadReplyClass();
$A->UploadReply();

?>
