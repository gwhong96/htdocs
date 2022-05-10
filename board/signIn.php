<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $email = $_POST['userEmail'];//signInForm에서 받아온 데이터
  $pw = $_POST['userPW'];

  function goSignInPage($alert){//alert 알림문구
    echo $alert.'<br>';
    echo "<a href = './signInForm.php'>로그인</a>";
    return;
  }

  if(!filter_Var($email,FILTER_VALIDATE_EMAIL)){//php 함수를 이용한 email형식 검사
    goSignInPage('올바른 이메일이 아닙니다.');
    exit;
  }

  if($pw == null || $pw == ''){//비밀번호 입력값 체크
    goSignInPage('비밀번호를 입력해 주세요.');
    exit;
  }

  $pw = hash('sha256', 'nasmedia'.$pw);//회원정보와 비교를 위한 해시 암호화

  $sql = "SELECT email, nickName, memberID FROM member ";
  $sql .= "WHERE email = '{$email}' AND memberPW = '{$pw}'";
  $result = $dbConnect -> query($sql);

  if($result){
    if($result->num_rows == 0){
      goSignInPage('로그인 정보가 일치하지 않습니다.');
      exit;
    }
    else{
      $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
      $_SESSION['memberID'] = $memberInfo['memberID'];
      $_SESSION['nickName'] = $memberInfo['nickName'];
      Header("Location:./index.php");//메인페이지로 이동
    }
  }

 ?>
