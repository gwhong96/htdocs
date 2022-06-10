
<?php
  //로그인 하지 않은 경우
  if(!isset($_SESSION['memberID'])){
    Header("Location:./index.php");
    exit;
  }

 ?>
