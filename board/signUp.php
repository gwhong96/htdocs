<!-- 회원가입 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';//회원가입 성공 시 세션 생성을 위한 include
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';//db접속을 위한 include

  //signUp.php 에서 form태그로 입력받은 데이터들을 변수로 받음
  $email = $_POST['userEmail'];
  $nickName = $_POST['userNickName'];
  $pw = $_POST['userPW'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];
  // $birthYear = $_POST['birthYear'];
  // $birthMonth = $_POST['birthMonth'];
  // $birthDay = $_POST['birthDay'];

  function goSignUpPage($alert){//입력값이 적합하지 않을 시 다시 회원가입 페이지로 이동
    echo $alert.'<br>';
    echo "<a href = './signUpForm.php'>회원가입</a>";
    return;
  }

  if(!filter_Var($email,FILTER_VALIDATE_EMAIL)){//php 함수를 이용한 email형식 검사
    goSignUpPage('올바른 이메일이 아닙니다.');
    exit;
  }//이메일 & 형식 체크

  // $nickNameRegPattern = '/^[가-힣]{1,}$/';//한글 구성 검사

  if($pw == null || $pw == ''){//비밀번호 입력값 체크
    goSignUpPage('비밀번호를 입력해 주세요.');
    exit;
  }//비밀번호 입력 체크

  //해시알고리즘을 통한 비밀번호 암호화
  $pw = hash('sha256', 'nasmedia'.$pw);//비밀번호 앞에 임의의 문자열을 붙여서 암호화


    if($birth ==0){
      goSignUpPage('생년월일을 입력해 주세요.');
    }

  // $birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;//date형식에 맞게 문자열 통합

  $isEmailCheck = false;//이메일 중복 검사용 변수 (default = false)

  $sql = "SELECT email FROM member WHERE email = '{$email}'";
  //테이블에 저장된 기존 email과의 중복 확인 쿼리
  $result = $dbConnect->query($sql);

  if($result){
    $count = $result->num_rows;
    if($count==0){//count가 0이면 중복이 없다는 뜻
      $isEmailCheck = true;
    }else{
      echo "이미 존재하는 이메일 입니다. ";
      goSignUpPage();
      exit;
    }
  }
  else{
    echo "에러발생 : 관리자 문의 요망";
    exit;
  }

  $isNickNameCheck = false;//nickName 중복 확인용 변수

  $sql = "SELECT nickName FROM member WHERE nickname = '{$nickName}'";
  //기존 닉네임과의 중복 확인 쿼리문
  $result = $dbConnect -> query($sql);

  if($result){
    $count = $result -> num_rows;
    if($count == 0){//이메일 중복이 없을 시
      $isNickNameCheck = true;
    }else{
      goSignUpPage('이미 존재하는 닉네임 입니다.');
      exit;
    }
  }else{
    echo "에러발생 : 관리자 문의 요망";
    exit;
  }

  if($isEmailCheck == true && $isNickNameCheck == true){//이메일과 닉네임의 중복이 없을 경우(즉, 가입 조건을 충족할 경우)
    $regTime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO member(email, nickname, memberPW, birthDay, gender ,regTime)";
    $sql .= "VALUES('{$email}', '{$nickName}', '{$pw}','{$birth}', '{$gender}' ,'{$regTime}')";
    $result = $dbConnect -> query($sql);

    if($result) {
      $_SESSION['memberID'] = $dbConnect -> insert_id;
      $_SESSION['nickName'] = $nickName;
      HEADER("Location:./index.php");
    }
    else {
      echo "회원가입 실패";
      exit;
    }
  }
  else{
    goSignUpPage('이메일 또는 닉네임이 중복되었습니다.');
    exit;
  }

 ?>
