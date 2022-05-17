<!-- 게시글 작성 및 수정 폼 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

 ?>

 <!doctype html>
 <html>
 <head>
</head>
<body>
  <?php
  $boardInfo = array();
  $boardID = '';
  // echo $_GET['boardID'];
  if(isset($_GET['boardID'])){
    $boardID = $_GET['boardID'];
    $sql = "SELECT m.memberID FROM member m JOIN board b ON (m.memberID = b.memberID) WHERE boardID = "."$boardID";
    $result2 = $dbConnect -> query($sql);
    $boardInfo2 = $result2 -> fetch_array(MYSQLI_ASSOC);

    if($boardInfo2['memberID'] == $_SESSION['memberID']){//현재 로그인 계정과 게시글 작성자가 같을때
      echo "게시글 수정";
      $boardID = $_GET['boardID'];
      $sql = "select * from board where boardID = {$boardID}";
      $result = $dbConnect -> query($sql);
      $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
    }else{
      echo "수정 권한이 없습니다."."<br>";
      echo "<a href = './list_designed.php'> 게시글 목록으로 돌아가기</a>";
      exit;
    }

  }else{
    echo "게시글 작성";
  }
    // print_r( $boardInfo);
   ?>
   <form name = "boardWrite" method = "post" action = "./write_ok.php">
     <input type="hidden" value='<?=$boardID?>' name = "boardID">
     제목
     <br>
     <input type = "text" name = "title" required value = "<?= (isset($boardInfo['title']) ? $boardInfo['title'] : '') ?>"></input>
     <br><br>
     내용
     <br>
     <textarea name = "content" cols = "80" rows = "10" required><?= (isset($boardInfo['content']) ? $boardInfo['content'] : '') ?></textarea>
     <br><br>
     비공개
     <?php
     if(isset($boardInfo['disYN'])){//게시글 수정일때

       if($boardInfo['disYN'] == 'N'){
         $checkYN = "checked";//기존 공개여부가 N이면 체크
       }else{
         $checkYN = "";
       }
     }else{$checkYN = "";}//게시글 작성일땐 체크 안함
     ?>
     <input type = "checkbox" name = "disYN" value = "N" <?= $checkYN ?>/>
     <br>
     비밀번호 <input type = "text" name = "boardPW">
     <br><br>
     <input type = "submit" value = "저장"/>
     <!--작성 완료-->
   </form>


</body>
</html>
