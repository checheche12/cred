<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: ./');
  exit;
}
?>

<link rel="stylesheet" type ="text/css" href="css/main.css">

<div id ='header'>

</div>
    <!--
        아래에 있는 코드는 DB에서 값을 가져 온 뒤에 동적으로 수정해야 한다. (수정 2)
      -->
      <div id = "pfpf" class = "ProfileBasicInfo">
      </div>

      <div id = "profileContent">
        <div id = "profileSelection">
          <ul>
            <li id = "Project">Project</li>
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
