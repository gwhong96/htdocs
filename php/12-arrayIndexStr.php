<?php

  $earth = array();

  $earth['nation'] = 'korea';
  // key-value 와 유사
  echo "earth배열의 nation인덱스는 ".$earth['nation'].'<br>';

  $earth2 = array('nation'=>'japan');
  echo "earth2배열의 nation 인덱스는  ".$earth2['nation'].'<br>';

  //round함수를 -3인덱스 부터 반올림
  echo "round를 이용한 반올림".round(12345,-3);

 ?>
