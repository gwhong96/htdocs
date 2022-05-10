<?php

  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';

  if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
    $boardID = $_GET['boardID'];
    $sql = "SELECT b.title, b.content, m.nickName, b.regTime, b.lastUpdate FROM board b ";
    $sql .= "JOIN member m on (m.memberID = b.memberID) ";
    $sql .= "WHERE b.boardID = {$boardID}";

    $result = $dbConnect -> query($sql);

    if($result){
      $contentInfo = $result -> fetch_array(MYSQLI_ASSOC);

      $v_sql = "UPDATE board set views = views + 1 where boardID = {$boardID}";//조회수 증가용 쿼리
      $v_result = $dbConnect -> query($v_sql);
      ?>

      <?= "제목 : ".$contentInfo['title']."<br>"?>
      <?= "작성자 : ".$contentInfo['nickName']."<br>"?>
      <?php $regTime = date("Y-m-d H:i:s") ?>
      <?= "게시일 : ".$contentInfo['regTime']."<br><br>"?>
      <?= "내용 : <br>"?>
      <?= $contentInfo['content']."<br>"?>
      <?= "마지막 수정 : "?>
      <?= $contentInfo['lastUpdate']."<br>"?>
      <?= "<a href = './list_designed.php'>목록으로 이동</a>"?>
      <!-- <?= "<a href = './modify.php'>게시글 수정</a>"?> -->
      <?= "<a href = '../board/modify.php?boardID={$boardID}'>게시글 수정" ?>
      <?= "<a href = '../board/delete.php?boardID={$boardID}'>게시글 삭제" ?>

    <?php
  }else{
    echo "잘못된 접근입니다.";
    exit;
  }
}else{
  echo "잘못된 접근입니다.";
  exit;
}

?>
