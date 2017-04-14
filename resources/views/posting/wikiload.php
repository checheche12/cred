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
              echo '<p id="noUOIP">처음으로 이 위키에 정보를 게시해 주세요!</p>';
              break;
            }
            echo '<p id="updatedate">최종 수정:&nbsp;'.$loadWikiSentence->wikiuploaddate.'</p>';
            echo '<p id="wikiInformation">'.$loadWikiSentence->wiki.'</p>';
            break;
        }
    }
}

$loadWiki = new loadWikiClass();
$loadWiki->loadWiki($_GET['int']);

?>
