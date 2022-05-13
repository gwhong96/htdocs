<!-- 회원가입 폼 -->
<!doctype html>
<html>
<head><title>Sign Up</title></head>

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
  <h1>Sign Up</h1>
  <form name = "signUp" method = "post" action="./signUp.php">
    이메일<br>
    <input type = "email" name = "userEmail" required>
    <br><br>
    닉네임<br>
    <input type = "text" name = "userNickName" required>
    <br><br>
    <input type = "radio" name = "gender" value = "m" checked>남
    <input type = "radio" name = "gender" value = "w">여
    <br><br>
    비밀번호<br>
    <input type = "password" name = "userPW" required>
    <br><br>
    생일<br>
    <input type = "text" id= "birthUI" name = "birth">

    <!-- slect문을 이용한 생일 선택 스크롤 -->
    <!-- <select name = "birthYear" required>
    <?php
    $thisYear = date('Y', time());

    for($i = $thisYear; $i >= 1930; $i--){
      echo "<option value='{$i}'>{$i}</option>";
    }
    ?>
    </select>년

    <select name = "birthMonth" required>
    <?php
    for($i = 1; $i <=12; $i++){
      echo "<option value='{$i}'>{$i}</option>";
    }
    ?>
    </select>월

    <select name = "birthDay" required>
    <?php
        for($i = 1; $i <=31; $i++){
          echo "<option value='{$i}'>{$i}</option>";
        }
    ?>
    </select>일 -->

    <br><br>
    <input type = "submit" value = "가입하기"/>
    <!-- form 태그내에 입력된 정보들을 action에 명시된 파일로 전송 -->
  </form>
</body>
</html>
