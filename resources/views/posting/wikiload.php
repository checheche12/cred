<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class loadWikiClass extends Controller
{
    function loadWiki($artPK)
    {
        $loadWikiSentences = DB::select("select wiki,wikiuploaddate from totalart where artPK = ?",[$artPK]);

          foreach($loadWikiSentences as $loadWikiSentence){
            if($loadWikiSentence->wikiuploaddate==null){
              echo '<p id="noUOIP">아직 작성된 게시물이 없습니다.</p>';
              break;
            }
            echo $loadWikiSentence->wikiuploaddate;
            echo "<br><br><br>";
            echo $loadWikiSentence->wiki;
            break;
        }
    }
}

$loadWiki = new loadWikiClass();
$loadWiki->loadWiki($_GET['int']);

?>
