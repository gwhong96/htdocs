<?php

  $str = "123문자열";
  echo "데이터형 변경 전 ".gettype($str)."<br>";


  $str = (int) $str;
  echo "데이터형 변경 후 ".gettype($str)." 값은 {$str}";

 ?>
