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
            senderuserPK = ? and recieveruserPK = ? order by DMPK desc',[$_SESSION['userPK'],$recieveruserPK,$recieveruserPK,$_SESSION['userPK']]);

            foreach($Selects as $Select){
              echo $Select->context."<br>";
            }
      }
}
