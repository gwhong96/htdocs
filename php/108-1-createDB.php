<?php
  $host = 'localhost';
  $user = 'root';
  $pw = '1234';
  $dbConnect = new mysqli($host, $user, $pw);
  $dbConnect->set_charset("utf8");

  if(mysqli_connect_errno()){
    echo '데이터베이스 접속 실패';
    echo mysqli_connect_error();
  }else {
    $sql = "CREATE DATABASE phpBoard";
    $res = $dbConnect->query($sql);

    if($res){
      echo '데이터베이스 생성완료';
    }
    else{
      echo '데이터베이스 생성실패';
    }
  }


 ?>
