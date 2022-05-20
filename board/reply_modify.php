<!--댓글 수정 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $boardID    = $_POST['boardID'];
  $reply      = $_POST['reply'];
  $replyID    = $_POST['replyID'];
  $date       = date("Y-m-d H:i:s");

  $sql  = "UPDATE reply SET ";
  $sql .= "reply = (?), replyDate = (?)";
  $sql .= "WHERE replyID = (?) AND boardID = (?)";

  $query = $dbConnect -> prepare($sql);
  $query -> bind_param('ssii', $reply, $date, $replyID, $boardID);
  $result = $query -> execute();

  echo "<script type='text/javascript'>alert('댓글 저장 완료');window.location = './view.php?boardID={$boardID}';</script>";


 ?>
