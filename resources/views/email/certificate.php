<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class changeAuthClass extends Controller
{
    public function changeAuth()
    {
        $email = base64_decode($_GET['aabbcc']);

        $fix = DB::update("update userinfo set Certification = 1 where Email = ?", [$email]);
        echo "변경이 완료되었습니다. 이제 이 아이디로 접속하실 수 있습니다.";
    }
}
$A = new changeAuthClass();
$A->changeAuth();

?>
