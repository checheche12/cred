<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mail;

class sendPasswordEmail extends Controller
{
    public function sendPassword($str)
    {
        $randomNumber = mt_rand(1,50);
        $to = base64_encode(base64_encode(base64_encode($str)));;
        for($i = 0; $i < $randomNumber%7; $i++){
          $to = base64_encode(base64_encode($to));;
        }
        $token = base64_encode($randomNumber);

        $subject = 'CRED Certification Email';
        $data = [
        'title' => 'Certification URL',
        'body' => '아래의 URL 을 클릭하시면 비밀번호 변경 페이지로 이동합니다.',
        'url' => "http://www.credberry.com/passwordgetinit?email=".$to."&token=".$randomNumber."&to=".$token
        ];
        return Mail::send('email.certification',$data,function($message) use($str, $subject){
          $message->to($str)->subject($subject);
        });
    }
}
$A = new sendPasswordEmail();
$A->sendPassword($_GET['ID']);
echo "입력하신 이메일로 메일을 발송해 주었습니다. 이메일에서 계속해주시기 바랍니다.";
echo "3초뒤에 메인 화면으로 이동합니다./n";
echo "<script type='text/javascript'>setTimeout(function(){
  document.location.href='./';
},3000);</script>";

?>
