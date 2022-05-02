<?php
//continue문을 이용한 스킵

  for($i = 0; $i < 10; $i++){
    if($i == 5){
      continue;
    }
    echo $i.',';
  }

 ?>
