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
        session_start();
        $userArt = array();
        $user = $_SESSION['userPK'].'artDB';
        $Sentence = 'select A.artPK, ArtURL, title from totalart A Inner Join artDB B on A.artPK = B.artPK
        and userPK = '.$_SESSION['userPK'];
        $users = DB::select(DB::raw($Sentence));

        // 루프를 돌면서 userArt 배열에 artPK 값과 artURL 의 값을 배열로 저장 중.
        foreach($users as $user){
            $imshi = array();
            $imshi = array($user->artPK,$user->ArtURL,$user->title);
            array_push($userArt,$imshi);
        }

        die(json_encode($userArt));

    }
}

$A = new UserController();
$A->index();

?>
