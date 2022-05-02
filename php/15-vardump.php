<?php
  //var_dump(변수명) *배열의 구조 파악*

  $dr = array();
  $dr['continent'] = array();

  $dr['continent']['america'] = array();
  $dr['continent']['america'][0] = '애너하임';
  $dr['continent']['america'][1] = '올랜도';

  $dr['continent']['asia'] = array();
  $dr['continent']['asia'][0] = '우라야스';
  $dr['continent']['asia'][1] = '홍콩';
  $dr['continent']['asia'][2] = '상하이';

  $dr['continent']['europe'] = array();
  $dr['continent']['europe'][0] = '파리';

  echo "<pre>";// html의 pre 태그 사용
  var_dump($dr);//dr배열의 구조 출력
  echo "</pre>";


 ?>
