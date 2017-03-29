<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

     // 그룹의 userPK 를 이용해서 멤버들의 userPK 를 가져온 뒤 userPK
     // 를 이용해서 user의 정보를 접근해서 json 형태로 반환

    public function index()
    {
        $Sentence = "select userPK from groupMemberDB where groupPK = ".$_GET['userPK'];
        $Users = DB::select(DB::raw($Sentence));
        $GLOBALS['userinfoArray'] = array();
        // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK
        foreach($Users as $k){
              $Sentence2 = "select * from userinfo where userPK = '".$k->userPK."'";
              $users2 = DB::select(DB::raw($Sentence2));
              foreach($users2 as $user){
                $A = array();
                array_push($A,$user->Email);
                array_push($A,$user->Name);
                array_push($A,$user->ProfilePhotoURL);
                array_push($A,$user->Career);
                array_push($A,$user->education);
                array_push($A,$user->userPK);
                array_push($GLOBALS['userinfoArray'],$A);
              }
        }
    }
}

$A = new UserController();
$A->index();
die(json_encode($GLOBALS['userinfoArray'],JSON_UNESCAPED_UNICODE));


?>
