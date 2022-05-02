<?php

  $str = "문자열";
  echo "데이터형 변경 전 ".gettype($str)."<br>";

  $str = (int) $str;
  echo "데이터형 변경 후 ".gettype($str)."값은 {$str}";
  //정수형으로 변경은 했으나 숫자로 표현이 안됨으로 0 출력

 ?>
