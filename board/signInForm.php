<!-- 로그인 폼 -->
<!doctype html>
<html>
<head></head>
<body>
<h1>로그인<h1>

<form name = "signIn" method = "post" action = "./signIn.php"><!--입력값 전송 대상 URL-->
  이메일<br>
  <input type = "email" name = "userEmail" required/>
  <br><br>
  비밀번호
  <br>
  <input type = "password" name = "userPW" required/>
  <br><br>
  <input type = "submit" value = "로그인"/>
</form>
</body>
</html>
