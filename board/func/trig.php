<!--히스토리 테이블 호출 함수 -->

<?php
include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

function log_history($boardID){

  $sql       = "SELECT * FROM history_board WHERE boardID = {$boardID}";
  $result    = $dbConnect -> query($sql);
  $dataCount = $result -> num_rows;

  for($i = 1; $i < $dataCount; $i++){
    $historyInfo = $result -> fetch_array(MYSQLI_ASSOC);
    $historyInfo2 = $result -> fetch_array(MYSQLI_ASSOC);

    if($historyInfo['action'] == 'insert'){
      echo "글 작성 : ".$historyInfo['dt_datetime'];
      echo "<br>";
    }else{

    }


  }

}
 ?>
