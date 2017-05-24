<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class deleteuser extends Controller
{
    public function delete()
    {
        DB::transaction(function(){
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
          DB::delete('delete from Connect where connectSenduserPK = ? or connectRecieveruserPK = ?',[$_GET['number'],$_GET['number']]);
          DB::delete('delete from groupMemberDB where userPK = ?',[$_GET['number']]);
          
        });
    }
}
$A = new deleteuser();
$A->delete();

?>
