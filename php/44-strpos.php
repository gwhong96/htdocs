<?php
//문자열 속 특정 문자 위치 찾기
//strpos('전체 문자열','찾을 문자')

  $str = 'web development';
  $findStr = 'd';

  $pos = strpos($str,$findStr);
  echo "문자열 {$findStr}의 위치는  : ".$pos;

 ?>
