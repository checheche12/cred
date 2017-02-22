<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>
<link rel="stylesheet" type ="text/css" href="css/informationEdit.css">

<div id = "header">

</div>

<input type = "text" id = ></input>

<?php
  echo "check Hello";
 ?>



<script type = "text/javascript" src = "js/jquery-3.1.1.min.js"></script>
<script type = "text/javascript" src = "js/informationEdit.js"></script>
