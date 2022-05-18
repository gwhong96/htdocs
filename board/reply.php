<!--댓글 정보 기입-->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/xssCheck.php';

  $boardID = $_POST['boardID'];
  $reply = $_POST['reply'];
  $writer = $_SESSION['nickName'];
  $replyPID = $_POST['replyPID'];
  $replyDate = date("Y-m-d H:i:s");

  if($reply != null && $reply != ''){
    $reply = $dbConnect -> real_escape_string($reply);
  }else{
    echo "<script type='text/javascript'>alert('댓글을 입력하세요.');</script>";
  }

  $reply = xss_clean($reply);//xss방어

  $sql = "INSERT INTO reply (boardID, writer, reply, replyDate, replyPID) ";
  $sql .= "VALUES ('{$boardID}', '{$writer}' ,'{$reply}', '{$replyDate}', '{$replyPID}') ";
  $result = $dbConnect -> query($sql);//새로운 댓글 삽입

  $sql = "SELECT * FROM reply where replyID = {$replyPID}";//부모 댓글의 정보 select
  $result = $dbConnect -> query($sql);
  $result_p = $result -> fetch_array(MYSQLI_ASSOC);

  if($replyPID != 0){
      $sql_up = "UPDATE reply SET replyDepth = {$result_p['replyDepth']}+1, replyOrder = {$result_p['replyOrder']}+1 ";
      $sql_up = "WHERE replyPID = {$replyPID}";//문제는 여기 부모 ID가 동일한 애들 구분..?

  }


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
