<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class makeNewArtClass extends Controller
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */
      public function makeNewArt()
      {
        $Sentence = "select Name from userinfo where userPK = ".$_SESSION['userPK'];
        $users = DB::select(DB::raw($Sentence));
        foreach($users as $user){
          $GLOBALS['name'] = $user->Name;
        }
        $artNumber = NULL;
        DB::insert('insert into totalart (title, ArtURL, Description,uploaddate,lastloaddate,uploader,uploaderName) values (?, ?, ?, ?, ?, ?, ?)',array($_POST['Title'],$_POST['ArtURL'],$_POST['Description'],date("Y-m-d H:i:s"),date("Y-m-d H:i:s"),$_SESSION['userPK'],$GLOBALS['name']));

        $Sentence3 = "select * from totalart order by artPK desc limit 1";

        $users3 = DB::select(DB::raw($Sentence3));
        foreach($users3 as $user){
          $artNumber=$user->artPK;
        }

        $Array = $_POST['main'];

        foreach($Array as $v1){
          DB::insert('insert into workDB (userPK, position, artPK)
            values (?, ?, ?)',array($v1[0],$v1[1],$artNumber));
          DB::insert('insert into artDB (artPK,userPK)
            values (?,?)',array($artNumber,$v1[0]));
          if($v1[0]!=$_SESSION['userPK']){
            DB::insert('insert into notification (senderuserPK,recieveruserPK,notificationKind,notificationPlacePK
              ,uploaddate) values (?,?,?,?,?)',[$_SESSION['userPK'],$v1[0],"3",$artNumber,date("Y-m-d H:i:s")]);
          }
        }
        DB::update('update workDB set checkCredit = 1 where userPK = ?',[$_SESSION['userPK']]);
        if(isset($_POST['Notuser'])){

          $Array = $_POST['Notuser'];
          foreach($Array as $v1){
            DB::insert('insert into TagNotUser (tagUser, position, artPK, unsignedEmail)
              values (?, ?, ?, ?)',array($v1[0],$v1[1],$artNumber,$v1[3]));

            //미 가입자들에게 이메일 보내기 $v1[3] -> email
            self::sendEmail($v1[3],$_POST['Title'],$GLOBALS['name'],$v1[0],$artNumber);
          }
        }

      }

      public function sendEmail($str,$work_title,$uploaderName,$creditedPerson,$artNumber){

        $to = base64_encode($str);
        $subject = '['+$work_title+']에 '+$creditedPerson+'님이 등록되었습니다. - '+$uploaderName;
        $data = [
        'title' => 'Cred 등록 알림',
        'body' => '아래의 URL 을 클릭하시면 당신이 참여한 작품을 확인할 수 있습니다.',
        'url' => "http://credmob.com/post?int=".$artNumber
        ];
        return Mail::send('email.certification',$data,function($message) use($str, $subject){
          $message->to($str)->subject($subject);
        });

      }

    }

    $A = new makeNewArtClass();
    $A->makeNewArt();

    ?>
