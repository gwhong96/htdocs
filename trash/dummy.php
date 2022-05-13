<?php

  include $_SERVER['DOCUMENT_ROOT'].'../board/connectDB.php';

  $regTime = date("Y-m-d H:i:s");//등록시간(timezone 설정 확인)

  for ($i = 2; $i <= 10; $i++){

    $sql = "INSERT INTO board (memberID, title, content, regTime, delYN, boardPW, disYN) ";
    $sql .= "VALUES('tester{$i}','{$i}번째 게시글', '{$i}번째 내용', '{$regTime}', 'N', '1234', 'Y') ";
    $result = $dbConnect -> query($sql);

    if($result){
      echo "{$i}번째 데이터 입력 완료";
    }else {
      echo "{$i}번째 데이터 입력 실패";
    }

  }


 ?>
