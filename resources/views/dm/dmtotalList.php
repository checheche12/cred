<?php

class DMTotalListClass
{
      /**
       * Show a list of all of the application's users.
       *
       * @return Response
       */

      public function DMTotalList($clickedPK)
      {
        $SelectsDMTotalLists = DB::select("select least(senderuserPK, recieveruserPK) as value1,
        greatest(senderuserPK, recieveruserPK) as value2 , MAX(DMPK) as DMPK from DirectMessage where
         senderuserPK = ? or recieveruserPK = ? group by value1, value2 order by MAX(DMPK) desc;",[$_SESSION['userPK'],$_SESSION['userPK']]);

         echo '
         <div id="searchDropdown">
           <input id="searchDMSlot" class="searchSlot" type="text" name="search" placeholder="Search.." >
           <br>
           <div id="searchDropdown_content">
           </div>

         </div>';

        foreach($SelectsDMTotalLists as $SelectsDMTotalList){

          $SelectDMLasts = DB::select("select senderuserPK, recieveruserPK, sendDate, context,
            B.ProfilePhotoURL as SenderProfilePhotoURL, C.ProfilePhotoURL as RecieverProfilePhotoURL
            ,B.Name as SenderName , C.Name as RecieverName
            from DirectMessage left join
            userinfo as B on senderuserPK = B.userPK left join userinfo as C on recieveruserPK = C.userPK where
            (senderuserPK = ? and recieveruserPK = ?) or (senderuserPK = ? and recieveruserPK = ?)
            order by DMPK desc limit 1",
            [$SelectsDMTotalList->value1,$SelectsDMTotalList->value2,$SelectsDMTotalList->value2,$SelectsDMTotalList->value1]);

          foreach($SelectDMLasts as $SelectDMLast){

            if($_SESSION['userPK']==$SelectDMLast->senderuserPK){
              echo '<a class="dmAnchor" href = "/dm?userPK='.$SelectDMLast->recieveruserPK.'">';
              if($clickedPK==$SelectDMLast->recieveruserPK){
                echo '<div class="dmListSelection dmActive">';
              }else{
                echo '<div class="dmListSelection">';
              }
              echo "<img class = 'img' src = '".$SelectDMLast->RecieverProfilePhotoURL."'></img>";
              if(empty($SelectDMLast->RecieverName)){
                echo '<p class="listSent">(알수없음) 님께 보낸 메세지</p>';
              }else{
                  echo '<p class="listSent">'.$SelectDMLast->RecieverName.' 님께 보낸 메세지</p>';
              }
              echo '<p class="contextSent">'.$SelectDMLast->context.'</p>';
              $date = date("Y-m-d H:m",strtotime($SelectDMLast->sendDate));
              echo '<p class="finalDate">'.$date.'</p>';

            }else{
              echo '<a class="dmAnchor" href = "/dm?userPK='.$SelectDMLast->senderuserPK.'">';
              if($clickedPK==$SelectDMLast->senderuserPK){
                echo '<div class="dmListSelection dmActive">';
              }else{
                echo '<div class="dmListSelection">';
              }
              echo "<img class = 'img' src = '".$SelectDMLast->SenderProfilePhotoURL."'></img>";
              if(empty($SelectDMLast->RecieverName)){
                echo '<p class="listSent">(알수없음) 님께 받은 메세지</p>';
              }else{
                echo '<p class="listRecieved">'.$SelectDMLast->SenderName.' 님께 받은 메세지</p>';
              }
              echo '<p class="contextRecieved">'.$SelectDMLast->context.'</p>';
              $date = date("Y-m-d H:m",strtotime($SelectDMLast->sendDate));
              echo '<p class="finalDate">'.$date.'</p>';
            }

            echo '</div>';
            echo '</a>';
            break;
          }

        }

      }
    }

    // $DMTotalListClass = new DMTotalListClass();
    // $DMTotalListClass->DMTotalList();

    ?>
    <link rel="stylesheet" type ="text/css" href="css/dmtotalList.css?v=1">

    <?php


    ?>
