<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

     /** art의 고유한 key를 이용해서 n+WorkDB를 호출한다.
     *  호출 후에 모든 리스트를 읽어서 json 형식으로 클라이언트 단에 반환한다.
     */

    public function index()
    {
        $userArt = array();
        $user = $_SESSION['userPK'].'artDB';
        $Sentence = 'select A.artPK, artURL from totalart A Inner Join '.$user.' B on a.artPK = B.artPK';
        $users = DB::select(DB::raw($Sentence));

        // 루프를 돌면서 userArt 배열에 artPK 값과 artURL 의 값을 배열로 저장 중.
        foreach($users as $user){
            $imshi = array();
            $imshi = array($user->artPK,$user->artURL);
            array_push($userArt,$imshi);
        }

        die(json_encode($userArt));

    }
}

$A = new UserController();
$A->index();

?>
