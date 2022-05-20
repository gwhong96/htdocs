<!-- 댓글 삭제 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $replyID = $_GET['replyID'];
  $boardID = $_GET['boardID'];
  
  // $delTime = date("Y-m-d H:i:s");//삭제 시간

  $sql = "UPDATE reply set delYN = 'Y' WHERE replyID = {$replyID}";//삭제 컬럼 업데이트 및 삭제 시간 추가

  $result = $dbConnect -> query($sql);

  if($result){
    echo "<script type='text/javascript'>alert('댓글 삭제 완료');window.location = './view.php?boardID={$boardID}';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('댓글 삭제 실패');window.location = './view.php?boardID={$boardID}';</script>";
  }

 ?>
