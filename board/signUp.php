<!-- 회원가입 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';//회원가입 성공 시 세션 생성을 위한 include
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';//db접속을 위한 include
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/passwordCheck.php';//비밀번호 정규식 체크용 include
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/mailCheck.php';//이메일 정규식 체크용 include

  //signUp.php 에서 form태그로 입력받은 데이터들을 변수로 받음
  $email = $_POST['userEmail'];
  $nickName = $_POST['userNickName'];
  $pw = $_POST['userPW'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];

  function goSignUpPage($alert){//입력값이 적합하지 않을 시 다시 회원가입 페이지로 이동
    echo $alert.'<br>';
    // echo "<a href = './signUpForm.php'>다시 입력</a>";
    echo "<button onclick='history.back()'>다시 입력하기</button>";
    return;
  }

  if(!filter_Var($email,FILTER_VALIDATE_EMAIL)){//php 함수를 이용한 email형식 검사
    goSignUpPage('올바른 이메일이 아닙니다.');
    exit;
  }else{
    $emailCheck = mailCheck($email);
    if($emailCheck == '0'){
      goSignUpPage('올바른 이메일이 아닙니다.');
      exit;
    }
  }

  // $nickNameRegPattern = '/^[가-힣]{1,}$/';//한글 구성 검사

  if($pw == null || $pw == ''){//비밀번호 입력값 체크
    goSignUpPage('비밀번호를 입력해 주세요.');
    exit;
  }else{
    $pwCheck =  passwordCheck($pw);//비밀번호 형식 체크
    if($pwCheck[0] == false){//불만족 시 해당 문구 출력
      echo $pwCheck[1];
      goSignUpPage('');
      exit;
    }
  }

  //해시알고리즘을 통한 비밀번호 암호화
  $pw = hash('sha256', 'nasmedia'.$pw);//비밀번호 앞에 임의의 문자열을 붙여서 암호화


    if($birth ==0){
      goSignUpPage('생년월일을 입력해 주세요.');
    }

  // $birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;//date형식에 맞게 문자열 통합

  $isEmailCheck = false;//이메일 중복 검사용 변수 (default = false)
  $isNickNameCheck = false;//nickName 중복 확인용 변수


  if(isset($_SESSION['memberID'])){//회원 정보 수정일 때    @@
    $time = date("Y-m-d H:i:s");
    $memberID = $_SESSION['memberID'];
    $sql = "UPDATE member SET email = '{$email}', nickName = '{$nickName}', gender = '{$gender}', ";
    $sql .= "birthDay = '{$birth}', memberPW = '{$pw}', modifyTime = '{$time}' ";
    $sql .= "WHERE memberID = '{$memberID}'";
    $result = $dbConnect -> query($sql);

    $_SESSION['nickName'] = $nickName;//수정된 닉네임 세션에 저장
    HEADER("Location:./index.php");


  }else{//회원 가입     @@@

    $sql = "SELECT email FROM member WHERE email = '{$email}'";
    //테이블에 저장된 기존 email과의 중복 확인 쿼리
    $result = $dbConnect->query($sql);

    if($result){
      $count = $result->num_rows;
      if($count==0){//count가 0이면 중복이 없다는 뜻
        $isEmailCheck = true;
      }else{//이메일 중복시
        goSignUpPage('이미 존재하는 이메일 입니다.');
        exit;
      }
    }else{//쿼리 결과 반환값이 없을 시
      echo "에러발생 : 관리자 문의 요망";
      exit;
    }

    $sql = "SELECT nickName FROM member WHERE nickname = '{$nickName}'";
    //기존 닉네임과의 중복 확인 쿼리문
    $result = $dbConnect -> query($sql);

    if($result){
      $count = $result -> num_rows;
      if($count == 0){//이메일 중복이 없을 시
        $isNickNameCheck = true;
      }else{//이메일 중복 없을 시
        goSignUpPage('이미 존재하는 닉네임 입니다.');
        exit;
      }
    }else{//쿼리 반환값 없을 시
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
      }else {
        echo "회원가입 실패";
        exit;
      }
    }else{
      goSignUpPage('이메일 또는 닉네임이 중복되었습니다.');
      exit;
    }
}
 ?>
