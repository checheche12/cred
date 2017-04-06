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
        $deleted = DB::delete('delete from indexMain');
        $insertResult = DB::insert('insert into indexMain (url,artText) values (?,?)',[$_POST['url'],$_POST['TEXT']]);
    }
}
$A = new getAlluser();
$A->getUser();

?>
