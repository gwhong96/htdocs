<!-- 게시글 작성 및 수정 -->

<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/xssCheck.php';

  $title    = $_POST['title'];
  $content  = $_POST['content'];
  $boardPW  = $_POST['boardPW'];
  $boardPW  = hash('sha256', 'nasmedia'.$boardPW);//게시글 비밀번호 해시암호화
  // print_r($_FILES['upfile']['name']);
  // var_dump($_POST);exit;


  if(isset($_POST['disYN'])){//비공개를 체크해서 N을 post받으면
    $disYN = $_POST['disYN'];//$disYN에 N 넣고
  }else{//체크박스를 체크하지 않으면
    $disYN = 'Y';//Y반환
  }

  if($title != null && $title != ''){//폼 체크
    $title = $dbConnect->real_escape_string($title);//title 내에 따옴표 같은 문자를 escape처리
  }else{//(글 제목이 비어있거나 공백문자면 다시 작성 페이지 호출)
    echo "제목을 입력하세요.";
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

  $regTime = date("Y-m-d H:i:s");//등록시간(timezone 설정 확인)
  $memberID = $_SESSION['memberID'];//현재 로그인한 회원의 ID

  $title = xss_clean($title);
  $content = xss_clean($content);//xss 방어

  if($_POST['boardID'] != ''){//게시글 수정시
    $boardID = $_POST['boardID'];
    $sql = "UPDATE board SET title = '{$title}', content = '{$content}', boardPW = '{$boardPW}', disYN = '{$disYN}', lastUpdate = '{$regTime}'";
    $sql .= "WHERE boardID = ".$boardID;
    $result = $dbConnect->query($sql);//입력 받은 값을 쿼리문을 통해 DB로 전달
  }else{//게시글 신규 작성시
    $sql = "INSERT INTO board (title, memberID, content, disYN, boardPW, regTime, lastUpdate)";
    $sql .= "VALUES ('{$title}', '{$memberID}','{$content}', '{$disYN}', '{$boardPW}','{$regTime}','{$regTime}')";
    $result = $dbConnect->query($sql);//입력 받은 값을 쿼리문을 통해 DB로 전달
    $boardID = mysqli_insert_id($dbConnect);//직전에 insert된 row의 pk값을 받아 첨부파일 테이블에 넣기위함
  }

  $uploadBase = '../upload/';

// 여기서 받는게 문제

  foreach ($_FILES['upfile']['name'] as $f => $name) {

      $save_dir = $_SERVER['DOCUMENT_ROOT'].'/upload/';
      $filename = $_FILES["upfile"]["name"][$f];
      $ext = pathinfo($filename,PATHINFO_EXTENSION);//확장자 구하기
      $newfilename = date("YmdHis").substr(rand(),0,6);//파일 이름 중복 방지
      $upfile = $newfilename.".".$ext;//새로운 파일 이름 + 확장자

      move_uploaded_file($_FILES["upfile"]["tmp_name"][$f], $save_dir.$upfile);

      $sql_upload =  "INSERT INTO upload_file (boardID, fileName, originalName) ";
      $sql_upload .= "VALUES ('{$boardID}', '{$upfile}', '{$filename}')";
      $result_upload = $dbConnect->query($sql_upload);
    }

  if($result){

    echo "<script type='text/javascript'>alert('저장 완료');window.location = './list.php';</script>";
    exit;
  }
  else{
    echo "<script type='text/javascript'>alert('저장 실패');window.location = './list.php';</script>";
    exit;
  }
 ?>
