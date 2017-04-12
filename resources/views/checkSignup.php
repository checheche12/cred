<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mail;

class UserController extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function makeNewUser()
      {
        $sameEmail = 0;
        $userNumber = 0;

        $users = DB::select(DB::raw("select * from userinfo where Email = '".$_POST['emailemail']."'" ));
        $sameEmail = empty($users);

            // 비어있다면 실행 안비어 있으면 에러 발생

        if($sameEmail){
          $PasswordLockss = DB::select(DB::raw('select PASSWORD("'.$_POST['pwpw'].'")'));
          foreach($PasswordLockss as $PasswordLocks){
            foreach($PasswordLocks as $PasswordLock){
              $GLOBALS['pLock'] = $PasswordLock;
            }
          }
          if($_POST['chk_info']=="personal"){
            DB::insert('insert into userinfo (Email, Password, Name, Certification, isgroup, ProfilePhotoURL) values (?, ?, ?, ?, ?, ?)',[$_POST['emailemail'],$GLOBALS['pLock'],$_POST['namename'],0,0,$_POST['hiddenPicURL']]);
            self::sendEmail($_POST['emailemail']);

          }else if($_POST['chk_info']=="group"){
            DB::insert('insert into userinfo (Email, Password, Name, Certification, isgroup, ProfilePhotoURL) values (?, ?, ?, ?, ?, ?)',[$_POST['emailemail'],$GLOBALS['pLock'],$_POST['namename'],0,1,$_POST['hiddenPicURL']]);
            self::sendEmail($_POST['emailemail']);
          }

          /**userExperience Table에 userPK 추가**/
          $Sentence = "select userPK from userinfo where Email = '".$_POST['emailemail']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
          DB::insert('insert into userExperience (userPK) values ('.$GLOBALS['userPK'].')');

        }
        else{
          echo "이미 존재하는 회원 email 입니다.";
        }
        echo "3초뒤에 메인 화면으로 이동합니다./n";
        echo "<script type='text/javascript'>setTimeout(function(){
          document.location.href='./';
        },3000);</script>";
      }

      public function sendEmail($str){

            echo "입력하신 이메일로 인증 메일을 발송하였습니다. 인증 확인후 사용해주시기 바랍니다.";
            $to = base64_encode($str);
          	$subject = 'CRED Certification Email';
          	$data = [
          	'title' => 'Certification URL',
          	'body' => '아래의 URL 을 클릭하시면 인증이 완료됩니다.',
            'url' => "http://www.credberry.com/certificate?aabbcc=".$to
          	];
          	return Mail::send('email.certification',$data,function($message) use($str, $subject){
          		$message->to($str)->subject($subject);
          	});

      }

  }
    $Exp = '/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i';
    if(preg_match($Exp,$_POST['emailemail'])==1){

      $A = new UserController();
      $A->makeNewUser();

    }else{
      echo "이메일 형식이 틀렸습니다. 3초뒤 메인화면으로 돌아갑니다./n";
      echo "<script type='text/javascript'>setTimeout(function(){
        document.location.href='./';
      },3000);</script>";
    }




?>
