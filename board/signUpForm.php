<!-- 회원가입 & 회원정보 수정 폼 -->
<!doctype html>
<html>
<head><title></title></head>

<!-- jQuery 기본 js파일 -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<!-- jQuery UI 라이브러리 js파일 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<script>
$(function(){ //jquery  달력 UI위젯 datepicker
      $("#birthUI").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
  });
</script>
<body>
  <?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';//$_SESSION값 받아오기 위해
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  if(isset($_SESSION['memberID'])){//회원정보 수정일 때
    $memberID = $_SESSION['memberID'];
    $sql = "SELECT memberID, nickName, memberPW, email, birthDay FROM member WHERE memberID = {$memberID}";
    $result = $dbConnect -> query($sql);
    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    echo "회원정보 수정";
  }else{//회원가입일 때
    echo "회원가입";
  }
   ?>

  <h1>Sign Up</h1>
  <form name = "signUp" method = "post" action="./signUp.php">
    이메일<br>
    <input type = "email" name = "userEmail" value = "<?= (isset($memberInfo['email']) ? $memberInfo['email'] : '') ?>" required>
    <br><br>
    닉네임<br>
    <input type = "text" name = "userNickName" value = "<?= (isset($memberInfo['nickName']) ? $memberInfo['nickName'] : '') ?>" required>
    <br><br>
    <input type = "radio" name = "gender" value = "m" checked>남
    <input type = "radio" name = "gender" value = "w">여
    <br><br>
    비밀번호<br>
    <input type = "password" name = "userPW" required><!--기존 비밀번호 표시 X-->
    <br><br>
    생일<br>
    <?php
      if(isset($memberInfo['memberID'])){
    ?>
      <input type = "text" id= "birthUI" value = "<?=$memberInfo['birthDay']?>" name = "birth">
      <br><br>
      <input type = "submit" value = "수정 정보 저장"/>
    <?php
  }else{
     ?>
    <input type = "text" id= "birthUI" name = "birth">
    <br><br>
    <input type = "submit" value = "가입하기"/>
    <?php
  }
  ?>

  </form>
</body>
</html>
