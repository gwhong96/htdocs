<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  unset($_SESSION['memberID']);
  unset($_SESSION['nickName']);
  echo "<script type='text/javascript'>alert('๋ก๊ทธ์์');window.location = './index.php';</script>";
 ?>
