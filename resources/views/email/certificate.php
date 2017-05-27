<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class changeAuthClass extends Controller
{
    public function changeAuth()
    {
        $string = base64_decode($_GET['aabbcc']);
        $string = base64_decode($string);
        $strings = explode('|',$string);
        $userPK = base64_decode($strings[0]);
        $Date = DB::select('select AuthDate from userAuth where userPK = ?',[$userPK]);
        if(empty($Date))//비어있다면
        {
          echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
          <body>
          <div id="signUpGuideFrame">
          <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
          <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
          <p class="signUpGuideP">이미 인증이 된 경로이거나 잘못된 경로입니다.</p><br>
          </div></body>';
          echo "<script type='text/javascript'>setTimeout(function(){
            document.location.href='./';
          },3000);</script>";
        }
        else
        {
            $DateTime = base64_decode($strings[2]);
            $Email = base64_decode($strings[1]);

            if($DateTime == $Date[0]->AuthDate){
              $fix = DB::update("update userinfo set Certification = 1 where userPK = ?", [$userPK]);
              DB::delete('delete from userAuth where userPK = ?',[$userPK]);
              echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
              <body>
              <div id="signUpGuideFrame">
              <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
              <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
              <p class="signUpGuideP">인증이 확인되었습니다. 등록하신 이메일로 로그인 하실 수 있습니다.</p><br>
              </div></body>';
              echo "<script type='text/javascript'>setTimeout(function(){
                document.location.href='./';
              },3000);</script>";
            }else{
              echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
              <body>
              <div id="signUpGuideFrame">
              <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
              <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
              <p class="signUpGuideP">인증 경로에 문제가 있습니다.</p><br>
              </div></body>';
              echo "<script type='text/javascript'>setTimeout(function(){
                document.location.href='./';
              },3000);</script>";
            }

        }
    }
}
$A = new changeAuthClass();
$A->changeAuth();

?>
