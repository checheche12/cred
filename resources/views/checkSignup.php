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
            $Sentence = "select userPK from userinfo where Email = '".$_POST['emailemail']."'";
            $users = DB::select(DB::raw($Sentence));
            foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
            $nowDateTime = date("Y-m-d H:i:s");
            DB::insert('insert into userAuth (userPK, AuthDate) values (?,?)',[$GLOBALS['userPK'],$nowDateTime]);
            self::sendEmail($GLOBALS['userPK'],$_POST['emailemail'],$nowDateTime);

          }else if($_POST['chk_info']=="group"){
            DB::insert('insert into userinfo (Email, Password, Name, Certification, isgroup, ProfilePhotoURL) values (?, ?, ?, ?, ?, ?)',[$_POST['emailemail'],$GLOBALS['pLock'],$_POST['namename'],0,1,$_POST['hiddenPicURL']]);
            $Sentence = "select userPK from userinfo where Email = '".$_POST['emailemail']."'";
            $users = DB::select(DB::raw($Sentence));
            foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
            $nowDateTime = date("Y-m-d H:i:s");
            DB::insert('insert into userAuth (userPK, AuthDate) values (?,?)',[$GLOBALS['userPK'],$nowDateTime]);
            self::sendEmail($GLOBALS['userPK'],$_POST['emailemail'],$nowDateTime);
          }

          /**userExperience Table에 userPK 추가**/
          $Sentence = "select userPK from userinfo where Email = '".$_POST['emailemail']."'";
          $users = DB::select(DB::raw($Sentence));
          foreach($users as $user){$GLOBALS['userPK'] = $user->userPK;}
          DB::insert('insert into userExperience (userPK) values ('.$GLOBALS['userPK'].')');

          echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
          <body>
          <div id="signUpGuideFrame">
          <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
          <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
          <p class="signUpGuideP">입력하신 이메일로 인증 메일을 발송하였습니다. </p><br>
          <p class="signUpGuideP">인증 확인 해주시면 회원가입이 완료됩니다.</p>
          </div></body>';

        }
        else{
            echo '<head><link rel="stylesheet" type ="text/css" href="css/checkSignup.css"></head>
            <body>
            <div id="signUpGuideFrame">
            <img id="signUpGuideImage1" src="/mainImage/credcheckmark.png"><br>
            <img id="signUpGuideImage2" src="/mainImage/signupImage/credberrymainlogo.png"><br>
            <p class="signUpGuideP">이미 있는 회원 이메일입니다.</p><br>
            </div></body>';
        }

      echo "<script type='text/javascript'>setTimeout(function(){
        document.location.href='./';
      },3000);</script>";
    }

    public function sendEmail($stringOne,$stringTwo,$stringThree){
      //str 1 은 userPK
      //str 2 는 Email
      //str 3 은 인증 날짜.

      $to1 = base64_encode($stringOne);
      $to2 = base64_encode($stringTwo);
      $to3 = base64_encode($stringThree);
      $to4 = $to1."|".$to2."|".$to3;
      $to4 = base64_encode($to4);
      $to4 = base64_encode($to4);
      $subject = 'CRED Certification Email';
      $data = [
      'title' => 'Certification URL',
      'body' => '아래의 URL 을 클릭하시면 인증이 완료됩니다.',
      'url' => "http://www.credmob.com/certificate?aabbcc=".$to4
      ];
      return Mail::send('email.certification',$data,function($message) use($stringTwo, $subject){
        $message->to($stringTwo)->subject($subject);
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
