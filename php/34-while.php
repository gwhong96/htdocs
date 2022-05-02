<?php
//while 반복문

  $sum = 0;//합산값 저장할 변수
  $num = 1;//누적합 시작값 선언

  while($num <= 10){
    $sum += $num;

    $num++;
  }

  echo "1부터 10까지 누적합은 {$sum}입니다."

 ?>
