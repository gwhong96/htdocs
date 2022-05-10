<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $boardID = $_GET['boardID'];

  $sql = "UPDATE board set delYN = 'Y' WHERE boardID = {$boardID}";

  $result = $dbConnect -> query($sql);

  if($result){
    echo "삭제 완료";
    echo "<a href = './list_designed.php'> 게시글 목록으로 이동</a>";
    exit;
  }
  else{
    echo "삭제 실패";
    echo "<a href = './list_designed.php'> 게시글 목록으로 이동</a>";
    exit;
  }

 ?>
