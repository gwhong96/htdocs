<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
?>

<!doctype html>
<html>
<head></head>
<body>
  <?php
    //if(isset($_SESSION['memberID'])){
      //echo $_SESSION['memberID'];
   ?>

   <a href="./list_designed.php">게시판</a>
   <br>
   <a href="./signOut.php">로그아웃</a>

   <?php
 //} else {
    ?>

   <!-- <a href="/signUPForm.php">회원가입</a>
   <br>
   <a href="/signInForm.php">로그인</a> -->

    <?php
//  }
   ?>
</body>
</html>
