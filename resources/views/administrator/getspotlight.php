<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class getSpotlightClass extends Controller
{
    public function getSpotlight()
    {

        $sentence = "select * from Spotlight order by spotPK desc limit 1";
        $a = DB::select($sentence);
        $artPKArr = array();
        $artPKArr[0] = 0;
        $artPKArr[1] = 0;
        $artPKArr[2] = 0;
        $artPKArr[3] = 0;
        foreach($a as $b){
            $artPKArr[0] = $b->artPK1;
            $artPKArr[1] = $b->artPK2;
            $artPKArr[2] = $b->artPK3;
            $artPKArr[3] = $b->artPK4;
        }

        for($i = 0 ; $i < 4; $i++){

            $Sentence2 = "select * from totalart where artPK = ".$artPKArr[$i];
            $getArts = DB::select($Sentence2);

            foreach($getArts as $getArt){
                $GLOBALS['artURL']=$getArt->ArtURL;
                $GLOBALS['uploaderName'] = $getArt->uploaderName;
            }
            if(self::urlCheck($GLOBALS['artURL'])=="youtube"){

              $yvID = self::matchYoutubeUrl($GLOBALS['artURL']);
              $GLOBALS['artURL'] = "https://img.youtube.com/vi/".$yvID.'/mqdefault.jpg';

            }

            $Sentence3 = "select A.userPK ,Position, Name from workDB as A join userinfo as B ON A.userPK = B.userPK and artPK = ".$artPKArr[$i];
            $getBridges = DB::select($Sentence3);


            echo '<div class="RecentWork">
              <a href="/post?int='.$artPKArr[$i].'">
                <img class="RecentWorkPic" src="'.$GLOBALS['artURL'].'"></a>
                <p class="workReference">'.$GLOBALS['uploaderName'].'</p>
                <div class="credit">
                  <div class="position_Frame">';

                    $k = 0;
                    foreach($getBridges as $getBridge){
                      echo '<p class="position">'.$getBridge->Position.'</p>';
                      $k+=1;
                      if($k >= 3){
                        break;
                      }
                    }

                  echo '</div>
                  <div class="splitter">
                  </div>
                  <div class="name_Frame">';
                  $k = 0;
                  foreach($getBridges as $getBridge){
                    echo '<a href = /anotherProfile?int='.$getBridge->userPK.'><p class="name">'.$getBridge->Name.'</p></a>';
                    $k+=1;
                    if($k >= 3){
                      break;
                    }
                  }

                  echo '</div>
                </div>
            </div>';

        }

    }

    public function urlCheck($url){
      if(self::matchYoutubeUrl($url) != false){
        return "youtube";
      }else{
        return "image";
      }
    }

    public function matchYoutubeUrl($url) {
      $p = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i';
      if(preg_match($p,$url,$matches)==1){
          return $matches[1]; // returns Youtube ID
      }
      return false;
    }

}
$A = new getSpotlightClass();
$A->getSpotlight();

?>
