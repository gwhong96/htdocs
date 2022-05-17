<!-- 초기화면 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/passwordCheck.php';
?>

<!doctype html>
<html>
<head></head>
<body>
  <?php if(!isset($_SESSION['memberID'])){//로그인 세션이 없으면  ?>

   <a href="./signUpForm.php">회원가입</a>
   <br>
   <a href="./signInForm.php">로그인</a>

   <?php } else {//로그인 되어있으면
    ?>

    <a href="./list_designed.php">게시판</a>
    <br>
    <a href="./signUpForm.php">회원정보 수정</a>
    <br>
    <a href="./signOut.php">로그아웃</a>

    <?php
    }
   ?>
</body>
</html>
