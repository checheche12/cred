<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $Sentence = 'select A.userPK from userinfo as A join workDB as B where A.Email = "'.$_GET['email'].'" and B.artPK = '.$_GET['artPK'].' and A.userPK = B.userPK';
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          die($user->userPK);
        }
        // 루프를 돌면서 userArt 배열에 artPK 값과 artURL 의 값을 배열로 저장 중.

    }
}

$A = new UserController();
$A->index();

?>
