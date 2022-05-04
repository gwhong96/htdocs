<?php
  include $_SERVER['DOCUMENT_ROOT'].'/php/108-2-connectDB.php';

  $sql = "DESC member";
  $res = $dbConnect->query($sql);

  $list = $res->fetch_array(MYSQLI_ASSOC);//변수 list에 fetch_array메소드 반환값 대입

  echo '<pre>';
  var_dump($list);//배열 구조 확인
  echo '</pre>';

 ?>
