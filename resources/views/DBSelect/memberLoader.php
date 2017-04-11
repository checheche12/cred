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

        foreach($Users as $k){
              $Sentence2 = "select * from userinfo where userPK = '".$k->userPK."'";
              $users2 = DB::select(DB::raw($Sentence2));
              foreach($users2 as $user){
                echo '<div class="bridgeCard" id = "'.$user->userPK.'">
                  <div class="optionFrame">
                  <button class="delete" id="delete'.$user->userPK.'">삭제</button>
                  </div>
                  <div class="personalImageFrame">
                  <img class="personalImage" src="'.$user->ProfilePhotoURL.'">
                  </div>
                  <div class="personalInfo">
                  <p class="name">'.$user->Name.'</p>
                  <p class="organization">'.$user->Career.'</p>
                  <p class="position">'.$user->education.'</p>
                  </div>
                  </div>';
              }
        }
    }
}

$A = new UserController();
$A->index();


?>
