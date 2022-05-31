<!--댓글 정보 기입-->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/xssCheck.php';

  $boardID    = $_POST['boardID'];
  $reply      = $_POST['reply'];
  $replyPID   = $_POST['replyPID'];
  $depth      = $_POST['depth'];
  $order      = $_POST['order'];

  $replyDate  = date("Y-m-d H:i:s");
  $writer_num = $_SESSION['memberID'];
  $writer     = $_SESSION['nickName'];


  if($reply != null && $reply != ''){
    $reply = $dbConnect -> real_escape_string($reply);
  }else{
    echo "<script type='text/javascript'>alert('댓글을 입력하세요.');</script>";
    exit;
  }

  $reply = xss_clean($reply);//xss방어

  $sql = "INSERT INTO reply (boardID, writer, writerID, reply, replyDate, replyPID) ";
  $sql .= "VALUES ('{$boardID}', '{$writer}','{$writer_num}' ,'{$reply}', '{$replyDate}', '{$replyPID}') ";
  $result = $dbConnect -> query($sql);//새로운 댓글 삽입
  // $result = mysql_query($sql);

  // $insertID = $dbConnect -> lastInsertId();
  $insertID = mysqli_insert_id($dbConnect);

  $sql_up = "UPDATE reply SET replyOrder = replyOrder + 1 WHERE replyOrder > {$order} AND boardID = {$boardID}";
  $result_up = $dbConnect -> query($sql_up);//기존 order값 변경

  if($replyPID != 0){//대댓글 이하 계층
    $sql_up2 = "UPDATE reply SET replyDepth = {$depth}+1, replyOrder = {$order}+1 ";
  }else{//댓글일 경우
    $sql_up2 = "UPDATE reply SET replyOrder = {$order}+1 ";
  }
    $sql_up2 .= "WHERE replyID = {$insertID}";
    $result_up2 = $dbConnect -> query($sql_up2);//새로운 댓글의 order값 업데이트

  if($result_up2){

    echo "<script type='text/javascript'>alert('댓글 저장 완료');window.location = './view.php?boardID={$boardID}';</script>";
    // alert('message');

    exit;
  }else{
    echo "댓글 저장 실패";
    echo "<a href = './view.php?boardID={$boardID}'> 게시글로 돌아가기</a>";
    exit;
  }

 ?>
