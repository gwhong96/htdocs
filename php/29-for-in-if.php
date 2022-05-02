<?php
//for 반복문 안에서 if 조건문 사용

  $sum = 0;
  $maxValue = 50;
  for ($i = 1; $i <= $maxValue; $i++){
    if($i % 2 == 0){//짝수일때
        $sum += $i;
    }
  }

  echo "1부터 {$maxValue}까지의 짝수 누적합 : {$sum}";

 ?>
