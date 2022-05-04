<?php
//settype(변수명, 변경할 데이터형)

  $val = "true";
  echo "변수 val의 데이터형 ".gettype($val);

  echo '<br>';
  settype($val, 'bool');//bool == boolean
  echo '변수 val의 데이터형 '.gettype($val).'<br>';

  var_dump($val);


 ?>
