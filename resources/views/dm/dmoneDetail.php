<?php

class dmoneDetailClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function dmoneDetail($recieveruserPK)
      {
            $Selects = DB::select('select * from DirectMessage where
            senderuserPK = ? and recieveruserPK = ? or
            senderuserPK = ? and recieveruserPK = ? order by DMPK asc',[$_SESSION['userPK'],$recieveruserPK,$recieveruserPK,$_SESSION['userPK']]);

            $Pict1s = DB::select('select Name,ProfilePhotoURL from userinfo where userPK = ?',[$_SESSION['userPK']]);
            $Pict2s = DB::select('select Name,ProfilePhotoURL from userinfo where userPK = ?',[$recieveruserPK]);

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

            foreach($Selects as $Select){
              if($Select->senderuserPK == $_SESSION['userPK']){
                echo "<div class = 'right'>
                      <div class = 'text'>".$Select->context." : 당신 </div>
                      <img class = 'rightimg' src = '".$Pict1['ProfilePhotoURL']."'></div>";
              }else{
                echo "<div class = 'left'>
                <img class = 'img' src = '".$Pict2['ProfilePhotoURL']."'>
                <div class = 'text'>".$Pict2['Name']."님 : ".$Select->context."</div></div>";
              }

            }
      }
}
