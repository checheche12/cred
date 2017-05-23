<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mail;

class makeNewArtClass extends Controller
{
  public function fixed(){
        /*
          $Sentence = "update totalart set description = '".$_POST['Description']."', title = '".$_POST['Title']."', ArtURL = '".$_POST['ArtURL']."' where artPK = '".$_POST['artPK']."'";
          $users = DB::update(DB::raw($Sentence));
        */
          DB::update("update totalart set description = ? , title = ? , ArtURL = ? where artPK = ?", [$_POST['Description'],$_POST['Title'],$_POST['ArtURL'],$_POST['artPK']]);

          $GLOBALS['creditAdder'] = array();
          $Sentence = DB::select("select * from workDB where artPK = ?",[$_POST['artPK']]);
          foreach($Sentence as $v){
            if($v->checkCredit == '1'){
              array_push($GLOBALS['creditAdder'],$v->userPK);
            }
          }

          $Sentence = "delete from workDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from artDB where artPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Sentence = "delete from TagNotUser where ArtPK = ".$_POST['artPK'];
          $users = DB::delete(DB::raw($Sentence));

          $Array = $_POST['main'];

          foreach($Array as $v1){
            DB::insert('insert into workDB (userPK, position, artPK)
              values (?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK']));
            DB::insert('insert into artDB (artPK,userPK)
              values (?,?)',array($_POST['artPK'],$v1[0]));
            if($v1[0]!=$_SESSION['userPK']){

              if(in_array($v1[0],$GLOBALS['creditAdder'])){
                DB::update('update workDB set checkCredit = 1 where userPK = ?',[$v1[0]]);

              }else{
                \App\Http\Middleware\notiSendFunction::notiMake_Place($_SESSION['userPK'],$v1[0],"3",$_POST['artPK']);
              }
            }else{
              DB::update('update workDB set checkCredit = 1 where userPK = ?',[$_SESSION['userPK']]);
            }
          }

          if(isset($_POST['Notuser']) and (count($_POST['Notuser'])>0)){

            //작성자 불러오는 mysql 문구
            $users = DB::select(DB::raw("select uploaderName from totalart where artPK = ".$_POST['artPK']));
            foreach($users as $user){
              $GLOBALS['name'] = $user->uploaderName;
            }

            $Array = $_POST['Notuser'];
            foreach($Array as $v1){
              $Exp = '/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i';
            if(preg_match($Exp,$v1[3])==1){ //미가입자 이메일 보내기
              DB::insert('insert into TagNotUser (tagUser, position, artPK, unsignedEmail, emailSent)
                values (?, ?, ?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK'],$v1[3],1));

              self::sendEmail($v1[3],$_POST['Title'],$GLOBALS['name'],$v1[0],$_POST['artPK']);
              // DB::update('update TagNotUser set emailSent = 1 where tagPK = ?',$tagPK);
            }else{  //미가입자 이메일이 형식에 맞춰 써있지 않는 경우
              DB::insert('insert into TagNotUser (tagUser, position, artPK, unsignedEmail)
                values (?, ?, ?, ?)',array($v1[0],$v1[1],$_POST['artPK'],$v1[3]));
            }
          }//end foreach($Array as $v1)
        }//end if(isset($_POST['Notuser']))

      }//function makeNewArt() end

      public function sendEmail($str,$work_title,$uploaderName,$creditedPerson,$artNumber){

        $to = base64_encode($str);
        $subject = '['.$work_title.']에 '.$creditedPerson.'님이 등록되었습니다. - '.$uploaderName;
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
    $A->fixed();
    ?>
