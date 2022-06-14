<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  unset($_SESSION['memberID']);
  unset($_SESSION['nickName']);
  echo "<script type='text/javascript'>alert('로그아웃');window.location = './index.php';</script>";
 ?>
