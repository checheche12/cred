<?php

class notifunctionClass
{
      public static function notification($noti)
      {
        if($noti->notificationKind == "1")
        {
          echo "<a href = '/anotherProfile?int=".$noti->userPK."'>
          <div>
            <img class = 'notiImage' src = '".$noti->ProfilePhotoURL."'></img><p class='notiStatement'>
            ".$noti->Name."님이 당신의 채용 공고에 지원하였습니다.</p>
          </div>
        </a>";
      }
      else if($noti->notificationKind == "2")
      {
        echo "<div id = '".$noti->artPK."' notinoti = '".$noti->notificationPK."'>
        <a href = '/post?int=".$noti->artPK."'>
          <div>
            <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
            <p class='notiStatement'>".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧 요청을 했습니다. 수락하시겠습니까?
              <p/></div>
            </a>
            <button id = 'yes' class = 'yesbutton'>수락</button>
            <button id = 'no' class = 'nobutton'>취소</button>
          </div>
          ";
        }
      else if($noti->notificationKind == "3")
      {
        echo "<div id = '".$noti->artPK."' notinoti = '".$noti->notificationPK."'>
        <a href = '/post?int=".$noti->artPK."'>
          <div>
            <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
            <p class='notiStatement'>".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧 요청을 했습니다. 수락하시겠습니까?
              <p/></div>
            </a>
            <button id = 'yes' class = 'yesbutton'>수락</button>
            <button id = 'no' class = 'nobutton'>취소</button>
          </div>
          ";
        }
        else if($noti->notificationKind == "5")
        {
          echo "<div id = '".$noti->artPK."'>
          <a href = '/post?int=".$noti->artPK."'>
            <div>
              <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
              <p class='notiStatement'>".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧을 요청한것을 수락했습니다.
                <p/></div>
              </a>
            </div>
            ";
          }
          else if($noti->notificationKind == "6")
          {
            echo "<div id = '".$noti->artPK."'>
            <a href = '/post?int=".$noti->artPK."'>
              <div>
                <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
                <p class='notiStatement'>".$noti->Name."님 이 ".$noti->title." 에 ".$noti->Position." 의 역할로 크레딧을 요청한것을 거절했습니다.
                </p></div>
              </a>
            </div>
            ";
          }else if($noti->notificationKind == "7")
          {
            echo "<div id = '".$noti->userPK."'>
            <a href = '/anotherProfile?int=".$noti->userPK."'>
              <img class = 'notiImage' ".$noti->ProfilePhotoURL."></img>
              <p class='notiStatement'>
                ".$noti->Name."님이 Connect 요청했습니다. 클릭하시면 프로필로 이동합니다.
              </p>
            </a>
          </div>";
        }else if($noti->notificationKind == "8")
        {
          echo "<div id = '".$noti->userPK."'>
          <a href = '/anotherProfile?int=".$noti->userPK."'>
            <div><p class='notiStatement'>
              ".$noti->Name."님의 Connect 요청을 수락했습니다.
            </p></div>
          </a>
        </div>";
      }else if($noti->notificationKind == "9")
      {
          echo "<div id = '".$noti->userPK."'>
          <a href = '/anotherProfile?int=".$noti->userPK."'>
            <div><p class='notiStatement'>
              ".$noti->Name."님이 Connect 요청을 거절했습니다.
            </p></div>
          </a>
        </div>";
      }

    }

}

$notifunctionClass = new notifunctionClass();

?>
