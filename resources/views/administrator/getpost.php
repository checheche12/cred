<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class getAllpost extends Controller
{
    public function getPost()
    {
        echo "<br><br><br>";
        $sentence = "select artPK, Title from totalart";
        $users = DB::select($sentence);
        foreach($users as $user){
            echo "<div class = 'artcard' id ='".$user->artPK."'>".$user->artPK."   ".$user->Title."</div><br><br>";
        }
    }
}
$A = new getAllpost();
$A->getPost();

?>
