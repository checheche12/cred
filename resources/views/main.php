<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>

<link rel="stylesheet" type ="text/css" href="css/main.css">

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
  </div>

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
    -->

  <div class = "mainProfile">
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
  </div>

  <div id = "profileContent">
    <div id = "profileSelection">
        <ul>
          <li id = "Project">Project</li>
          <li id = "Bridge_Log">Bridge Log</li>
          <li id = "Bridge">Bridge</li>
        </ul>
    </div>
    <div id = "profileBody">
        <?php

         ?>
    </div>
  </div>

<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */


?>

<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/main.js"></script>
