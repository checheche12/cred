<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class loadWikiClass extends Controller
{
    function loadWiki($artPK)
    {
        $loadWikiSentences = DB::select("select wiki from totalart where artPK = ?",[$artPK]);

          foreach($loadWikiSentences as $loadWikiSentence){

            echo $loadWikiSentence->wiki;
            break;
        }
    }
}

$loadWiki = new loadWikiClass();
$loadWiki->loadWiki($_GET['int']);

?>
