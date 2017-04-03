<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class deleteuser extends Controller
{
    public function delete()
    {
        $sentence = "delete from userinfo where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from groupMemberDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from workDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from artDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from keywordDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from groupkeywordDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from careerDB where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);
        $sentence = "delete from userExperience where userPK = ".$_GET['number'];
        $a = DB::delete($sentence);

    }
}
$A = new deleteuser();
$A->delete();

?>
