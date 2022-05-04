<?php

  include $_SERVER['DOCUMENT_ROOT'].'../board/connectDB.php';

  $title = $_POST['title'];
  $content = $_POST['content'];
  $name = $_POST['name'];

  if($title != null && $title != ''){//폼 체크
    $title = $dbConnect->real_escape_string($title);//title 내에 따옴표 같은 문자를 escape처리
  }else{//(글 제목이 비어있거나 공백문자면 다시 작성 페이지 호출)
    echo "제목을 입력하시오.";
    echo "<a href = './write.php'>작성 페이지로 이동 </a>";
    exit;
  }

  if($content != null && $content != ''){
    $content = $dbConnect->real_escape_string($content);
  }else{
    echo "내용을 입력하시오.";
    echo "<a href = './write.php'>작성 페이지로 이동 </a>";
    exit;
  }

  if($name != null && $name != ''){
    $name = $dbConnect->real_escape_string($name);
  }else{
    echo "작성자를 입력하시오.";
    echo "<a href = './write.php'>작성 페이지로 이동 </a>";
    exit;
  }

  $regTime = date("Y-m-d",time());

  $sql = "INSERT INTO board (title, content, name, regTime)";
  $sql .= "VALUES ('{$title}', '{$content}', '{$name}', '{$regTime}')";
  $result = $dbConnect->query($sql);//입력 받은 값을 쿼리문을 통해 DB로 전달

  if($result){
    echo "저장 완료";
    echo "<a href = './list.php'> 게시글 목록으로 이동</a>";
    exit;
  }
  else{
    echo "저장 실패";
    echo "<a href = './list.php'> 게시글 목록으로 이동</a>";
    exit;
  }
 ?>
