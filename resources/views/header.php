<link rel="stylesheet" type ="text/css" href="css/header.css">

  <div id = "header">
    <img id = "credImage" src = "mainImage/CredLogo.jpg">

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 1)
    -->

    <?php
        echo '<div id = "profile">';
        echo '<img id = "profileImage" src = "mainImage/profile.jpg">';
        echo '<div id = "profileName">mina</div>';
        echo '</div>';
     ?>
     <button id = "upload"></button>
     <button id = "logout">로그아웃</button>
  </div>


<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/header.js"></script>
