<?php
  session_start();
  if(!isset($_SESSION['is_login'])){
    header('Location: ./');
    exit;
  }
?>

<?php
  $Array = $_POST['main'];
  echo $Array[1][1];
 ?>
