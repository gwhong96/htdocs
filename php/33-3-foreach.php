<?php
//foreach문에서 배열의 인덱스를 얻는 방법

  $memberList = ['name' => '미우', 'id' => 'miu'];

  foreach($memberList as $index => $value){
    echo "인덱스 {$index}의 값 : {$value}".'<br>';
  }

//출력 결과
/*
인덱스 name의 값 : 미우
인덱스 id의 값 : miu
*/

 ?>
