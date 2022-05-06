<?php

  include $_SERVER['DOCUMENT_ROOT'].'../board/connectDB.php';

  if(isset($_GET['boardID']) && (int) $_get['boardID']" > 0){
    &boardID = $_GET['board'];
    $sql = "SELECT b.title, b.content, m.name, b.regTime FROM board b ";
    $sql .= "JOIN member"
  }




 ?>
