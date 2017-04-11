<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class uploadWikiClass extends Controller
{
    function uploadWiki()
    {
        $upload = DB::update("update totalart set wiki = ? , wikiuploaddate = ? where artPK = ? ",[$_POST['wiki'],date("Y-m-d H:i:s"),$_POST['artPK']]);
    }
}

$A = new uploadWikiClass();
$A->uploadWiki();

?>
