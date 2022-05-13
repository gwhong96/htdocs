<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  // $boardID = $_GET['boardID'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  // $name = $_POST['name'];
  $disYN = $_POST['disYN'];//공개여부

  if($title != null && $title != ''){//폼 체크
    $title = $dbConnect->real_escape_string($title);//title 내에 따옴표 같은 문자를 escape처리
  }else{//(글 제목이 비어있거나 공백문자면 다시 작성 페이지 호출)
    echo "제목을 입력하시오.";
    echo "<a href = './modify.php'>수정 페이지로 이동 </a>";
    exit;
  }

  if($content != null && $content != ''){
    $content = $dbConnect->real_escape_string($content);
  }else{
    echo "내용을 입력하시오.";
    echo "<a href = './modify.php'>수정 페이지로 이동 </a>";
    exit;
  }

  $regTime = date("Y-m-d H:i:s");//등록시간

  $memberID = $_SESSION['memberID'];

  $title = htmlspecialchars($title);
  $content = htmlspecialchars($content);//xss 방어를 위해 함수를 적용한뒤 DB에 저장

  $sql = "UPDATE board SET title = '{$title}', content = '{$content}', disYN = '{$disYN}' ";
  $sql .= "WHERE boardID = ".$boardID;
  $result = $dbConnect->query($sql);//입력 받은 값을 쿼리문을 통해 DB로 전달

  if($result){
    echo "수정 완료";
    echo "<a href = './list_designed.php'> 게시글 목록으로 이동</a>";
    exit;
  }
  else{
    echo "수정 실패";
    echo "<a href = './list_designed.php'> 게시글 목록으로 이동</a>";
    exit;
  }
 ?>
