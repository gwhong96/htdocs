<!--댓글 수정 및 삭제 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';

  $boardID    = $_POST['boardID'];
  $reply      = $_POST['reply'];
  $replyID   = $_POST['replyID'];
  $date  = date("Y-m-d H:i:s");

  $sql  = "UPDATE reply SET ";
  $sql .= "reply = (?) ";
  $sql .= "WHERE replyID = (?) AND boardID = (?)";
  $sql -> bind_param('sii', $reply, $replyID, $boardID);
  $result = $dbConnect -> query($sql);



 ?>
