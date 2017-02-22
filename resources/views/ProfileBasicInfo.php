<?php
    session_start();
?>

<link rel="stylesheet" type ="text/css" href="css/ProfileBasicInfo.css">

<?php
    echo '<img id = "profileImage2" src = "mainImage/profile.jpg">';
    echo '<p class="name">Test 1</p>';
    echo '<p class="organization">CRED</p>';
    echo '<p class="position">Chief Chef</p>';

    echo '<button id = "informationEdit">프로필 수정하기</button>';

    echo '<p class="location">GangNam</p>';
    echo '<p class="email">email@cred.com</p>';
    echo '<hr>';
    echo '<p class="personalDescription">';
    echo 'art university<br> <br> Capable of: <br> producer, art
         director,<br> music video<br> <br> Community and Brand
        Designer/Illustrator<br> Wix.Com — Tel Aviv-Yafo, Israel<br>
        <br> Story Designer<br> Jimdo GmbH — Hamburg, Germany';
    echo '</p>';
?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/ProfileBasicInfo.js"></script>
