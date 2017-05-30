<?php

class dmSendClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function dmSend()
      {
          $isItUser = DB::select('select * from userinfo where userPK = ? ',[$_POST['recieveruserPK']]);
          if(!empty($isItUser)){
            DB::transaction(function(){
              $insertDM = DB::insert('insert into DirectMessage (senderuserPK,
              recieveruserPK, sendDate, context) values (?,?,?,?)'
              ,[$_SESSION['userPK'],$_POST['recieveruserPK'],date("Y/m/d H:i:s",time()),$_POST['DMText']]);
              $update = DB::update('update userinfo set msgCheck = msgCheck+1
              where userPK = ?',[$_POST['recieveruserPK']]);

              echo date("Y/m/d H:i",time());
            });
          }
          else{
            echo "error";
          }

      }
}

$DMSend = new dmSendClass();
$DMSend->dmSend();
