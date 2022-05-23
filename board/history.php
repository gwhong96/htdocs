<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  $boardID = $_GET['boardID'];

  $sql       = "SELECT * FROM history_board WHERE boardID = {$boardID}";
  $result    = $dbConnect -> query($sql);
  $dataCount = $result -> num_rows;

  $pre_views = 0;

  for($i = 1; $i <= $dataCount; $i++){
    $historyInfo = $result -> fetch_array(MYSQLI_ASSOC);

    if($historyInfo['action'] == 'insert'){
      echo "글 작성 : ".$historyInfo['dt_datetime'];
      echo "<br>";
    }else{//action 컬럼값이 'update' 일때
      if($historyInfo['views'] != $pre_views){
        echo "글 조회 : ".$historyInfo['dt_datetime'];
        echo "<br>";
      }elseif($historyInfo['delYN'] == 'Y'){
        echo "글 삭제 : ".$historyInfo['dt_datetime'];
        echo "<br>";
      }else{
        echo "글 수정 : ".$historyInfo['dt_datetime'];
        echo "<br>";
      }

      $pre_views = $historyInfo['views'];

    }
}


 ?>
