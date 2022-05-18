<!--댓글 정보 기입-->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/xssCheck.php';

  $boardID = $_POST['boardID'];
  $reply = $_POST['reply'];

  $writer = $_SESSION['nickName'];

  if($reply != null && $reply != ''){
    $reply = $dbConnect -> real_escape_string($reply);
  }else{
    echo "<script type='text/javascript'>alert('댓글을 입력하세요.');</script>";
  }

  $replyDate = date("Y-m-d H:i:s");
  $reply = xss_clean($reply);


  // if($replyDepth == 0){//즉 댓글이면
  //   //replyPID 에 replyID 대입하는 sql문 작성
  // }else{
  //   //post로 받을 PID를 replyPID에 대입
  // }

  $sql = "INSERT INTO reply (boardID, writer, reply, replyDate) ";
  $sql .= "VALUES ('{$boardID}', '{$writer}' ,'{$reply}', '{$replyDate}') ";

  $result = $dbConnect -> query($sql);

  if($result){
    echo "댓글 저장 완료";
    echo "<a href = './view.php?boardID={$boardID}'> 게시글로 돌아가기</a>";
    exit;
  }else{
    echo "댓글 저장 실패";
    echo "<a href = './view.php?boardID={$boardID}'> 게시글로 돌아가기</a>";
    exit;
  }

 ?>
