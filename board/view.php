<!-- 게시글 상세보기 -->
<?php

  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/xss.php';

  if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){//이전 페이지의 url정보
    $referer=$_SERVER['HTTP_REFERER'];
  }else{
    $referer="";
  }//url을 통한 부정 접근 방지

  if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
    if($referer == ''){exit("잘못된 접근입니다.");}//url을 따라 접근하게 되면 이전 페이지 url이 '' 임으로 걸러낼 수 있다.

    $boardID = $_GET['boardID'];
    $sql = "SELECT b.title, b.content, m.nickName, b.regTime, b.lastUpdate, b.disYN FROM board b ";
    $sql .= "JOIN member m on (m.memberID = b.memberID) ";
    $sql .= "WHERE b.boardID = {$boardID} AND b.delYN = 'N'";

    $result = $dbConnect -> query($sql);
    $dataCount = $result->num_rows;
    if($dataCount > 0 ){
      $contentInfo = $result -> fetch_array(MYSQLI_ASSOC);
      $v_sql = "UPDATE board set views = views + 1 where boardID = {$boardID}";//조회수 증가용 쿼리
      $v_result = $dbConnect -> query($v_sql);
      ?>

      <?= "제목 : ".$contentInfo['title']."<br>"?>
      <?= "작성자 : ".$contentInfo['nickName']."<br>"?>
      <?php $regTime = date("Y-m-d H:i:s") ?>
      <?= "게시일 : ".$contentInfo['regTime']."<br><br>"?>
      <?= "내용 : <br>"?>
      
      <?= nl2br($contentInfo['content'])."<br>"?>

      <!--htmlspecialchars 를 통해 치환된 스크립트 중에 사용가능한 태그들만 복구해서 사용
          ex) h p br hr ...... -->
      <!-- specialchars 대신 xss 공격 가능성이 있는 태그들만 str_replace 하는 방법. -->

      <?= "마지막 수정 : "?>
      <?= $contentInfo['lastUpdate']."<br>"?>
      <!--history에서 이전 페이지의 url을 불러와 이동-->
      <?= "<button onclick='history.back()'>이전 페이지</button>"?>
      <?= "<a href = '../board/write.php?boardID={$boardID}'>게시글 수정" ?>
      <?= "<a href = '../board/delete.php?boardID={$boardID}'>게시글 삭제" ?>

    <?php
  }else{
    echo "잘못된 접근입니다.";
    echo "<a href = '../board/list_designed.php'>게시판</a>";
    exit;
  }
}else{
  echo "잘못된 접근입니다.";
  echo "<a href = '../board/list_designed.php'>게시판</a>";
  exit;
}

?>
