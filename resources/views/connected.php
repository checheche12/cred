<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class connectedMemberClass
{
    public function connectedMember()
    {
        $connectedMember = DB::select('select A.stats, B.userPK, B.Name, B.ProfilePhotoURL, B.Career, B.education from Connect as A
        left join userinfo as B on connectRecieveruserPK = userPK
        where connectSenduserPK = ? and stats = 2;',[$_POST['userPK']]);

        foreach($connectedMember as $A){

          if($A->stats == "2")
          {
            // 0 email, 1 name 2 포토 url 3 career 4 education 5 userPK 6 isgroup
            echo '<a href = "/anotherProfile?int='.$A->userPK.'">';
            echo '<table class="bridgeCard">';
            echo '<tr>';
            echo '<td class="personalImageFrame">';
            echo '<img class="personalImage"src="'.$A->ProfilePhotoURL.'">';
            echo '</td> '.'<td class="personalInfo">';
            echo '<p class="name">'.$A->Name.'</p>';
            echo '<p class="organization">'.$A->Career.'</p>';
            echo '<p class="position">'.$A->education.'</p>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            echo '</a>';
          }
        }
    }
}


$A = new connectedMemberClass();
$A->connectedMember();

?>
