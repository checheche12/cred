<?php

class DMTotalListClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function DMTotalList()
      {
            $SelectsDMTotalLists = DB::select("select distinct least(A.senderuserPK, A.recieveruserPK)
            as value1, greatest(A.senderuserPK,A.recieveruserPK) as value2
            from DirectMessage as A where senderuserPK = ? or recieveruserPK = ?",[$_SESSION['userPK'],$_SESSION['userPK']]);

            foreach($SelectsDMTotalLists as $SelectsDMTotalList){

                $SelectDMLasts = DB::select("select senderuserPK, recieveruserPK, sendDate, context,
                B.ProfilePhotoURL as SenderProfilePhotoURL, C.ProfilePhotoURL as RecieverProfilePhotoURL
                 from DirectMessage left join
                 userinfo as B on senderuserPK = B.userPK left join userinfo as C on recieveruserPK = C.userPK where
                 (senderuserPK = ? and recieveruserPK = ?) or (senderuserPK = ? and recieveruserPK = ?)
                  order by DMPK desc limit 1",
                [$SelectsDMTotalList->value1,$SelectsDMTotalList->value2,$SelectsDMTotalList->value2,$SelectsDMTotalList->value1]);

                foreach($SelectDMLasts as $SelectDMLast){
                  echo '<a href = "/dm">';
                  echo '<div>';
                  echo "<img class = 'img' src = '".$SelectDMLast->SenderProfilePhotoURL."'></img>";
                  echo "<img class = 'img' src = '".$SelectDMLast->RecieverProfilePhotoURL."'></img>";
                  echo $SelectDMLast->context;
                  echo '</div><br><br>';
                  echo '</a>';
                  break;
                }

            }
      }
}

$DMTotalListClass = new DMTotalListClass();
$DMTotalListClass->DMTotalList();

?>
<link rel="stylesheet" type ="text/css" href="css/dmtotalList.css?v=1">

<?php


?>
