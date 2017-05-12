<?php

class dmoneDetailClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function dmoneDetail($recieveruserPK,$recieverAccount)
      {
            $Selects = DB::select('select * from DirectMessage where
            senderuserPK = ? and recieveruserPK = ? or
            senderuserPK = ? and recieveruserPK = ? order by DMPK desc limit ?, 15 ',[$_SESSION['userPK'],$recieveruserPK,$recieveruserPK,$_SESSION['userPK'],$recieverAccount]);

            $Pict1s = DB::select('select Name,ProfilePhotoURL from userinfo where userPK = ?',[$_SESSION['userPK']]);
            $Pict2s = DB::select('select Name,ProfilePhotoURL from userinfo where userPK = ?',[$recieveruserPK]);

            $Selects = array_reverse($Selects);

            $Pict1 = array(); // 나
            $Pict2 = array(); // 대화 상대

            foreach($Pict1s as $P1){
              $Pict1['ProfilePhotoURL'] = $P1->ProfilePhotoURL;
              $Pict1['Name'] = $P1->Name;
            }
            foreach($Pict2s as $P2){
              $Pict2['ProfilePhotoURL'] = $P2->ProfilePhotoURL;
              $Pict2['Name'] = $P2->Name;
            }
            echo "<div id = 'forAppend'></div>";
            foreach($Selects as $Select){
              if($Select->senderuserPK == $_SESSION['userPK']){
                echo "<div class = 'right'>
                      <div class = 'rtext'>".$Select->context."</div>
                      <img class = 'rightImg' src = '".$Pict1['ProfilePhotoURL']."'></div>";
              }else{
                echo "<div class = 'left'>
                <img class = 'leftImg' src = '".$Pict2['ProfilePhotoURL']."'>
                <div class = 'ltext'>".$Select->context."</div></div>";
              }

            }
      }
}
