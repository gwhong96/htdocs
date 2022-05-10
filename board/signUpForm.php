<!doctype html>
<html>
<head><title>Sign Up</title></head>
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

    <!-- slect문을 이용한 선택 스크롤 -->
    <select name = "birthYear" required>
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
    </select>일

    <br><br>
    <input type = "submit" value = "가입하기"/>
    <!-- form 태그내에 입력된 정보들을 action에 명시된 파일로 전송 -->
  </form>
</body>
</html>
