<?php

class notiaddClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function notiadd()
      {
            $GLOBALS['notification'] = DB::select("select A.checknotification, A.notificationPK ,A.notificationKind,B.userPK,B.ProfilePhotoURL,
              B.Name,C.title,C.artPK, D.Position,A.notificationPlacePK
              from notification as A left join userinfo as B on A.senderuserPK = B.userPK
              left join totalart as C on C.artPK = A.notificationPlacePK
              left join workDB as D on C.artPK = D.artPK and A.recieveruserPK = D.userPK
              where A.recieveruserPK = ? order by notificationPK DESC limit ?, 15;",[$_SESSION['userPK'],$_GET['recieverNotiAccount']]);

            include_once('../resources/views/noti/notifunction.php');
            foreach($GLOBALS['notification'] as $noti){
              $notifunctionClass->notification($noti);
            }
      }
}


$dmaddDetailMake = new notiaddClass();
$dmaddDetailMake->notiadd();
