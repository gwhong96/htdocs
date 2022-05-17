<!-- 게시글 삭제 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $boardID = $_GET['boardID'];

  $delTime = date("Y-m-d H:i:s");//삭제 시간

  $sql = "UPDATE board set delYN = 'Y', delTime = '{$delTime}' WHERE boardID = {$boardID}";//삭제 컬럼 업데이트 및 삭제 시간 추가

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
