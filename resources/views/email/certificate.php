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
        echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
        <body>
        <div id="signUpGuideFrame">
        <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
        <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
        <p class="signUpGuideP">인증이 확인되었습니다. 등록하신 이메일로 로그인 하실 수 있습니다.</p><br>
        </div></body>';

    }
}
$A = new changeAuthClass();
$A->changeAuth();

?>
