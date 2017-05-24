<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

if($_SESSION['persongroup'] != "administrator"){
  header('Location: ./');
  exit;
}

class deletepost extends Controller
{
    public function delete()
    {
        DB::transaction(function()
        {
          $sentence = "delete from totalart where artPK = ".$_GET['number'];
          $a = DB::delete($sentence);
          $sentence = "delete from workDB where artPK = ".$_GET['number'];
          $a = DB::delete($sentence);
          $sentence = "delete from artDB where artPK = ".$_GET['number'];
          $a = DB::delete($sentence);
        });
    }
}
$A = new deletepost();
$A->delete();

?>
