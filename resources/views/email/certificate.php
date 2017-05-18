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
        <p class="signUpGuideP">입력하신 이메일로 인증 메일을 발송하였습니다. </p><br>
        <p class="signUpGuideP">인증 확인 해주시면 회원가입이 완료됩니다.</p>
        </div></body>';

    }
}
$A = new changeAuthClass();
$A->changeAuth();

?>
