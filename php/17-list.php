<?php

  //리스트를 이용하여 변수에 배열 값 대입
  $fruit = array();
  $fruit = ['grape', 'strawberry', 'apple'];

  list($first, $second, $third) = $fruit;
  echo $second;

 ?>
