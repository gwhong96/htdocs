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
  <title>View | nasmedia</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="./css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./js/init-alpine.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  <script src="https://kit.fontawesome.com/aee31d5c5a.js"></script>
</head>

<body>
  <h3><a href="./list.php"><img src="../img/logo.svg"></a></h3>
  <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">VIEW</h4>

<?php
  if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){//이전 페이지의 url정보
    $referer=$_SERVER['HTTP_REFERER'];
  }else{
    $referer="";
  }//url을 통한 부정 접근 방지

  if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
    if($referer == ''){exit("잘못된 접근입니다.");}

    $boardID = $_GET['boardID'];
    $sql = "SELECT b.title, b.content, m.memberID, m.nickName, b.regTime, b.lastUpdate, b.disYN FROM board b ";
    $sql .= "JOIN member m on (m.memberID = b.memberID) ";
    $sql .= "WHERE b.boardID = {$boardID} AND b.delYN = 'N'";

    $result = $dbConnect -> query($sql);
    $dataCount = $result->num_rows;

    $sql_upload = "SELECT * FROM upload_file WHERE boardID = '{$boardID}' AND originalName <> ''";
    $result_upload = $dbConnect -> query($sql_upload);
    $dataCount2 = $result_upload->num_rows;

    if($dataCount > 0 ){
      $contentInfo = $result -> fetch_array(MYSQLI_ASSOC);
      $v_sql = "UPDATE board set views = views + 1 where boardID = {$boardID} ";//조회수 증가용 쿼리
      $v_result = $dbConnect -> query($v_sql);
      ?>
      <div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg dark:bg-gray-800">
          <div class="w-full" style="width:80%">
            <span style="color: rgb(64,64,64);" class="mb-4 text-2xl font-semibold text-gray-700"> <?=$contentInfo['title']?> </span>
            <span class="text-xs text-gray-700">by</span>
            <span class="text-xl" style="color:gray"><?=$contentInfo['nickName']?></span> <br><br>
            <?php $regTime = date("Y-m-d H:i:s") ?>
            <span style="float:right">Wirten : <?=$contentInfo['regTime']?></span><br>
            <span style="float:right">Modified : <?= $contentInfo['lastUpdate']?></span><br><br><br>
            <div style="border: 1px solid #d3d3d3;min-height: 250px;"><?=nl2br($contentInfo['content'])?></div>
            <br><br>
            <?= "첨부파일 : "?>
            <br>
      <?php
      if($dataCount2 > 0){//첨부파일이 존재한다면
        for($i = 0; $i < $dataCount2; $i++){//첨부파일 갯수만큼 반복
          $uploadInfo = $result_upload -> fetch_array(MYSQLI_ASSOC);
          echo "<a href='../upload/{$uploadInfo['fileName']}' download> {$uploadInfo['originalName']}"."</a>";

          if($contentInfo['memberID']==$_SESSION['memberID']){
              echo "<a href='./deleteFile.php?fileID={$uploadInfo['fileID']}&boardID={$boardID}'> <em class='fa fa-trash-o' style='color:gray;'></em></a><br>";
          }else{
            echo "<br>";
          }

        }
      }else{
        echo "첨부파일 없음";
      }
      ?>
      </a><br><br>
      <?php
      if($contentInfo['nickName'] == $_SESSION['nickName']){
        echo "<button type='button' style='background :  #6D6E71' class='items-center px-2 py-1 text-sm font-medium text-white rounded-lg'/><a href='./write.php?boardID={$boardID}'>게시글 수정</a></button> ";
        echo "<button type='button' style='background :  #6D6E71' class='items-center px-2 py-1 text-sm font-medium text-white rounded-lg'/><a href='./delete.php?boardID={$boardID}'>게시글 삭제</a></button>";
      }
    }else{
      echo "잘못된 접근입니다.";
      echo "<a href = '../board/list.php'>게시판</a>";
      exit;
    }?>


<!-- 댓글 입력 -->
  <br><br><br>

        <?php
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
            <textarea style = "background : lightgray;width:60%;height:50px" name="reply" required></textarea><br>
            <button style = "background :  #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">댓글 저장</button>
          </form>
          <br><br>
      <?php
          if($dataCount>0){
            for($i = 1; $i <= $dataCount; $i++){
              $replyInfo  = $result -> fetch_array(MYSQLI_ASSOC);
              $depth      = $replyInfo['replyDepth'];
              $replyID    = $replyInfo['replyID'];
              $modify     = $replyInfo['modifyDate'];

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
                echo nl2br($replyInfo['reply'])."&nbsp&nbsp&nbsp";
                echo $replyInfo['replyDate']."&nbsp";
              }else{
                echo "삭제된 댓글 입니다.";
              }

            ?>
            <button class = 'button1 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style="background :  #6D6E71" reply_id="<?=$replyID?>">답글</button>
            <?php
            if($replyInfo['writerID'] == $_SESSION['memberID'] && $replyInfo['delYN'] == 'N'){?>
              <button class = 'button2 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style="background :  #6D6E71" modify_id="<?=$replyID?>">수정</button>
              <?= "<button class = 'button2 items-center px-2 py-1 text-sm font-medium text-white rounded-lg' style='background :  #6D6E71'/><a href = './reply_delete.php?replyID={$replyID}&boardID={$boardID}'>삭제</a></button>"?>
            <?php }?>


            <?php
              echo "</div><br>";

              ?>
              <form id = "replyWrite<?=$replyID?>" method = "post" action="./reply_ok.php" style="display:none">
                <input type="hidden" value ='<?=$replyInfo['replyOrder']?>' name = "order">
                <input type="hidden" value ='<?=$depth?>' name = "depth">
                <input type="hidden" value ='<?=$boardID?>' name = "boardID">
                <input type="hidden" value ='<?=$replyID?>' name = "replyPID">
                <textarea style="background : lightgray" name="reply" cols = "30" rows = "3" required></textarea>
                <button style = "background :  #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">답글 저장</button>
                <br>
              </form>

              <form id = "replyModify<?=$replyID?>" method = "post" action="./reply_modify.php" style="display:none">
                <input type="hidden" value ='<?=$boardID?>' name = "boardID">
                <input type="hidden" value ='<?=$replyID?>' name = "replyID">
                <textarea style="background : lightgray" name="reply" cols = "30" rows = "3" required><?=$replyInfo['reply']?></textarea>
                <button style = "background : #6D6E71" class="items-center px-2 py-1 text-sm font-medium text-white rounded-lg" type = "submit">답글 수정</button>
                <br>
              </form>
              <?php
            }//for문 끝나는 지점
          }else{
            echo "댓글이 없습니다.";
          }
        }else{
          echo "<script type='text/javascript'>alert('잘못된 접근입니다.');window.location = './list.php';</script>";
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
