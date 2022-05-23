<!-- 게시글 상세보기 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/xssCheck.php';
  ?>

<!doctype html>
<html>
<head>
</head>
<body>

<?php
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
      <?= "마지막 수정 : "?>
      <?= $contentInfo['lastUpdate']."<br>"?>
      <!--history에서 이전 페이지의 url을 불러와 이동-->
      <!-- <?= "<button onclick='history.back()'>이전 페이지</button>"?> -->
      <?= "<a href = './list_designed.php'>게시글 목록</a>"?>

      <?php
      if($contentInfo['nickName'] == $_SESSION['nickName']){
        echo "<a href = './write.php?boardID={$boardID}'>게시글 수정</a>";
        echo "<a href = './delete.php?boardID={$boardID}'>게시글 삭제</a>";
      }
      ?>

    <?php
    }else{
      echo "잘못된 접근입니다.";
      echo "<a href = '../board/list_designed.php'>게시판</a>";
      exit;
    }?>
<!-- 댓글 입력 -->
  <br><br><br>

        <?php
        //댓글 조회
          $sql         = "SELECT * FROM reply ";
          $sql        .= "where boardID = '{$boardID}' ";
          $sql        .= "order by replyOrder";
          $result      = $dbConnect->query($sql);
          $dataCount   = $result -> num_rows;
          ?>

          <form method = "post" action="./reply_ok.php" name = "reply0">
            <input type="hidden" value ='0' name = "order">
            <input type="hidden" value ='0' name = "depth">
            <input type="hidden" value ='<?=$boardID?>' name = "boardID">
            <input type="hidden" value ='0' name = "replyPID">
            <textarea name="reply" cols = "40" rows = "5" required></textarea>
            <input type = "submit" value = "댓글 저장"/>
          </form>
          <br><br>
      <?php
          if($dataCount>0){
            for($i = 1; $i <= $dataCount; $i++){
              $replyInfo  = $result -> fetch_array(MYSQLI_ASSOC);
              $depth      = $replyInfo['replyDepth'];
              $replyID    = $replyInfo['replyID'];

              echo "<div>";
              if($depth == 0){//댓글
                echo "--";
              }else{//대댓글 이하
                for ($j = 0; $j < $depth; $j++){
                  echo "&nbsp&nbsp&nbsp&nbsp";
                }
                echo "ㄴ";
              }

              if($replyInfo['delYN'] == 'N'){
                echo $replyInfo['writer']."&nbsp:&nbsp";
                echo $replyInfo['reply']."&nbsp&nbsp&nbsp";
                echo $replyInfo['replyDate']."&nbsp";
              }else{
                echo "삭제된 댓글 입니다.";
              }

            ?>
            <button class = 'button1' reply_id="<?=$replyID?>">답글</button>
            <?php
            if($replyInfo['writer'] == $_SESSION['nickName'] && $replyInfo['delYN'] == 'N'){?>
              <button class = 'button2' modify_id="<?=$replyID?>">수정</button>
              <?= "<a href = './reply_delete.php?replyID={$replyID}&boardID={$boardID}'>삭제</a>"?>
            <?php }?>


            <?php
              echo "</div><br>";
              ?>
              <form id = "replyWrite<?=$replyID?>" method = "post" action="./reply_ok.php" style="display:none">
                <input type="hidden" value ='<?=$replyInfo['replyOrder']?>' name = "order">
                <input type="hidden" value ='<?=$depth?>' name = "depth">
                <input type="hidden" value ='<?=$boardID?>' name = "boardID">
                <input type="hidden" value ='<?=$replyID?>' name = "replyPID">
                <textarea name="reply" cols = "40" rows = "5" required></textarea>
                <br>
                <input type = "submit" value = "답글 저장"/>
                <br>
              </form>

              <form id = "replyModify<?=$replyID?>" method = "post" action="./reply_modify.php" style="display:none">
                <input type="hidden" value ='<?=$boardID?>' name = "boardID">
                <input type="hidden" value ='<?=$replyID?>' name = "replyID">
                <textarea name="reply" cols = "40" rows = "5" required><?=$replyInfo['reply']?></textarea>
                <br>
                <input type = "submit" value = "답글 수정"/>
                <br>
              </form>
              <?php
            }//for문 끝나는 지점
          }else{
            echo "댓글이 없습니다.";
          }
        }else{
          echo "잘못된 접근입니다.";
          echo "<a href = '../board/list_designed.php'>게시판</a>";
          exit;
        }?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          $(document).ready(function(){
            $(".button1").click(function(){//답글 작성
              var reply_id = $(this).attr('reply_id');
              $("#replyWrite"+reply_id).toggle();
            });
            $(".button2").click(function(){//댓글 수정
              var modify_id = $(this).attr('modify_id');
              $("#replyModify"+modify_id).toggle();
            });
          });
        </script>
</body>
</html>
