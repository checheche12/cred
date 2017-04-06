<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class getAlluser extends Controller
{
    public function getUser()
    {
        $insertResult = DB::insert('insert into Spotlight (artPK1,artPK2,artPK3,artPK4,updatedate) values (?,?,?,?,?)',[$_POST['first'],$_POST['second'],$_POST['third'],$_POST['fourth'],date("Y-m-d H:i:s")]);
    }
}
$A = new getAlluser();
$A->getUser();

?>
