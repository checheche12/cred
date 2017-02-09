<!--
이거 뭐하는 코드인지 까먹었다.;;;
-->

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::select(DB::raw("select * from userinfo"));
        foreach($users as $user){
          echo $user->Name;
          echo '<br>';
          echo $user->Email;
          echo '<br>';
        }
    }
}

$A = new UserController();
$A->index();

?>
