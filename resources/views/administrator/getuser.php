<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

session_start();

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class getAlluser extends Controller
{
    public function getUser()
    {
        echo "<br><br><br>";
        $sentence = "select userPK, Email, Name from userinfo";
        $users = DB::select($sentence);
        foreach($users as $user){
            echo "<div class = 'usercard' id = '".$user->userPK."'>".$user->userPK."   ".$user->Email."   ".$user->Name."</div><br><br>";
        }
    }
}
$A = new getAlluser();
$A->getUser();

?>
