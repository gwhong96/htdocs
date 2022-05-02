<?php
  $dr = array();//배열 선언
  $dr['continent'] = array();//dr의 continent 인덱스를 배열로 선언

  $dr['continent']['america'] = array();//dr['continent']의 america를 배열로 선언
  $dr['continent']['america'][0] = '애너하임';
  $dr['continent']['america'][1] = '올랜도';

  $dr['continent']['asia'] = array();
  $dr['continent']['asia'][0] = '우라야스';
  $dr['continent']['asia'][1] = '홍콩';
  $dr['continent']['asia'][2] = '상하이';

  $dr['continent']['europe'] = array();
  $dr['continent']['europe'][0] = '파리';

  echo "다음 도시의 공통점은?";
  echo "<br><br>";
  echo "아메리카 : <br>";
  echo $dr['continent']['america'][0].'<br>';
  echo $dr['continent']['america'][1].'<br>';
  echo '<br>';

  echo "아시아 : <br>";
  echo $dr['continent']['asia'][0].'<br>';
  echo $dr['continent']['asia'][1].'<br>';
  echo $dr['continent']['asia'][2].'<br>';
  echo '<br>';

  echo "유럽 : <br>";
  echo $dr['continent']['europe'][0];


 ?>
