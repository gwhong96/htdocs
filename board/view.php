<!-- 게시글 상세보기 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/xss.php';
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
      <?= "<a href = './write.php?boardID={$boardID}'>게시글 수정</a>"?>
      <?= "<a href = './delete.php?boardID={$boardID}'>게시글 삭제</a>"?>

    <?php
    }else{
      echo "잘못된 접근입니다.";
      echo "<a href = '../board/list_designed.php'>게시판</a>";
      exit;
    }?>
<!-- 댓글 입력 -->
  <br><br><br>
    <!-- 댓글 작성 버튼 여기 추가하고 -->

    <br>

        <?php
        //댓글 조회
          $sql = "SELECT * FROM reply ";
          $sql .= "where boardID = '{$boardID}' ";
          $sql .= "order by replyOrder";
          $result = $dbConnect->query($sql);
          $dataCount = $result -> num_rows;


          if($dataCount>0){
            for($i = 1; $i <= $dataCount; $i++){
              $replyInfo = $result -> fetch_array(MYSQLI_ASSOC);
              $depth = $replyInfo['replyDepth'];

              echo "<div>";
              if($depth == 0){
                echo "--";
              }else{
                for ($j = 0; $j < $depth; $j++){
                  echo "&nbsp&nbsp&nbsp&nbsp";
                }
                echo "ㄴ";
              }
              echo $replyInfo['writer'];
              echo $replyInfo['reply'];
              echo $replyInfo['replyDate'];
            ?>
            <button p_id='replyWrite' onclick="show_box();">댓글</button>

            <?php
              echo "</div><br>";
              ?>
              <form id = "replyWrite" name = "replyWrite" method = "post" action="./reply.php" style="display:none">
                <input type="hidden" value ='<?=$boardID?>' name = "boardID">
                <input type="hidden" value ='<?=$replyInfo['replyPID']?>' name = "replyPID">
                <textarea name="reply" cols = "40" rows = "5" required></textarea>
                <br>
                <!--댓글일 경우 0을 전송, 이외에는 부모의 ID를 전송하게 하는 버튼 필요 -->
                <input type = "submit" value = "댓글 저장"/>
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
        }
        ?>
        <!--jquery 사용하기 위한 호출-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          function show_box(ele){
            // console.log($(ele).attr('p_id'));
            $("#replyWrite").css("display","block");
          }
          function hide_box(){
            $("#replyWrite").css("display","none");
          }
        </script>
</body>
</html>
