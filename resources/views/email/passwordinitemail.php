<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mail;

class sendPasswordEmail extends Controller
{
    public function sendPassword($str)
    {

      /*
        $randomNumber = mt_rand(1,50);
        $to = base64_encode(base64_encode(base64_encode($str)));;
        for($i = 0; $i < $randomNumber%7; $i++){
          $to = base64_encode(base64_encode($to));;
        }
        $token = base64_encode($randomNumber);
      */
        $dateTime = date("Y-m-d H:i:s");
        $userPKThing = DB::select('select userPK from userinfo where Email = ?',[$str]);
        DB::insert('insert into userAuth (userPK, AuthDate) values (?,?)',[$userPKThing[0]->userPK,$dateTime]);
        $to1 = base64_encode($userPKThing[0]->userPK);
        $to2 = base64_encode($str);
        $to3 = base64_encode($dateTime);
        $to4 = $to1."|".$to2."|".$to3;
        $to4 = base64_encode($to4);
        $to4 = base64_encode($to4);
        $subject = 'CRED Certification Email';
        $data = [
        'title' => 'Certification URL',
        'body' => '아래의 URL 을 클릭하시면 비밀번호 변경 페이지로 이동합니다.',
        'url' => "http://www.credmob.com/passwordgetinit?aabbcc=".$to4
        ];
        return Mail::send('email.certification',$data,function($message) use($str, $subject){
          $message->to($str)->subject($subject);
        });
    }

    public function updatePassword($str)
    {

      /*
        $randomNumber = mt_rand(1,50);
        $to = base64_encode(base64_encode(base64_encode($str)));;
        for($i = 0; $i < $randomNumber%7; $i++){
          $to = base64_encode(base64_encode($to));;
        }
        $token = base64_encode($randomNumber);
      */
        $dateTime = date("Y-m-d H:i:s");
        $userPKThing = DB::select('select userPK from userinfo where Email = ?',[$str]);
        DB::update('update userAuth set AuthDate = ? where userPK = ?',[$dateTime,$userPKThing[0]->userPK]);
        //str 1 은 userPK
        //str 2 는 Email
        //str 3 은 인증 날짜.
        $to1 = base64_encode($userPKThing[0]->userPK);
        $to2 = base64_encode($str);
        $to3 = base64_encode($dateTime);
        $to4 = $to1."|".$to2."|".$to3;
        $to4 = base64_encode($to4);
        $to4 = base64_encode($to4);
        $subject = 'CRED Certification Email';
        $data = [
        'title' => 'Certification URL',
        'body' => '아래의 URL 을 클릭하시면 비밀번호 변경 페이지로 이동합니다.',
        'url' => "http://www.credmob.com/passwordgetinit?aabbcc=".$to4
        ];
        return Mail::send('email.certification',$data,function($message) use($str, $subject){
          $message->to($str)->subject($subject);
        });
    }
}
$userPKs = DB::select('select userPK from userinfo where Email = ?',[$_GET['ID']]);
if(!empty($userPKs))
{
  $isuserAuth = DB::select('select * from userAuth where userPK = ?',[$userPKs[0]->userPK]);
  if(empty($isuserAuth))
  {
    $A = new sendPasswordEmail();
    $A->sendPassword($_GET['ID']);
    echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
    <body>
    <div id="signUpGuideFrame">
    <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
    <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
    <p class="signUpGuideP">입력하신 이메일로 메일을 발송하였습니다.</p><br>
    </div></body>';
    echo "<script type='text/javascript'>setTimeout(function(){
      document.location.href='./';
    },3000);</script>";
  }
  else
  {
    $A = new sendPasswordEmail();
    $A->updatePassword($_GET['ID']);
    echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
    <body>
    <div id="signUpGuideFrame">
    <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
    <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
    <p class="signUpGuideP">입력하신 이메일로 메일을 발송하였습니다.</p><br>
    </div></body>';
    echo "<script type='text/javascript'>setTimeout(function(){
      document.location.href='./';
    },3000);</script>";
  }
}
else
{
  echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
  <body>
  <div id="signUpGuideFrame">
  <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
  <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
  <p class="signUpGuideP">사이트에 등록되지 않은 이메일입니다.</p><br>
  </div></body>';
  echo "<script type='text/javascript'>setTimeout(function(){
    document.location.href='./';
  },3000);</script>";
}


?>
