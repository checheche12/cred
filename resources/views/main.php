<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
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
  </div>

    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
    -->

  <div id = "mainProfile">
    <?php
        echo '<img id = "profileImage2" src = "mainImage/profile.jpg">';
        echo 'name<br>';
        echo 'school<br>';
        echo '직책';
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
