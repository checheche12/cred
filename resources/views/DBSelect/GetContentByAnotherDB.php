<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

     /** 유저 정보에서 PK와 DB를 조합해서 그 사람의 DB에 접근해서 작품의
     * PK 를 얻어오고 그 PK로 작품의 URL에 접근해서 URL을 받아온 뒤
     * 모든 URL의 정보를 JSON 형태로 반환하여 클라이언트 단에 준다.
     */
    public function index()
    {
        $userArt = array();
        $user = $_GET['userPK'].'artDB';
        $Sentence = 'select A.artPK, ArtURL, title, position from totalart A Inner Join workDB B on A.artPK = B.artPK
        and userPK = '.$_GET['userPK'];
        $users = DB::select(DB::raw($Sentence));

        // 루프를 돌면서 userArt 배열에 artPK 값과 artURL 의 값을 배열로 저장 중.
        foreach($users as $user){
            $urlType = self::urlCheck($user->ArtURL);
            if($urlType == "youtube"){

                $yvID = self::matchYoutubeUrl($user->ArtURL);
                $imgSrc = "https://img.youtube.com/vi/".$yvID.'/mqdefault.jpg';
                echo '<a href = "/post?int='.$user->artPK.'"><div class = "ProjectFrame"><img class = "VideoArt" src = '.$imgSrc.'><div class="detail"><p class="name">'.$user->title.'</p><p class="position">'.$user->position.'</p></div></div></a>';

            }else{
                echo '<a href = "/post?int='.$user->artPK.'"><div class = "ProjectFrame"><img class = "VideoArt" src = '.$user->ArtURL.'><div class="detail"><p class="name">'.$user->title.'</p><p class="position">'.$user->position.'</p></div></div></a>';
            }

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

$A = new UserController();
$A->index();

?>
