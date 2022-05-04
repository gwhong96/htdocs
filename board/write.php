<?php

 ?>

 <!doctype html>
 <html>
 <head>
</head>
<body>
  <form name = "boardWrite" method = "post" action = "save.php">
    제목
    <br>
    <input type = "text" name = "title" required/>
    <br><br>
    작성자
    <br>
    <input type = "text" name = "name" required/>
    <!-- <br><br>
    게시글 PW
    <br>
    <input type = "text" name = "boardPW" required/> -->
    <br><br>
    내용
    <br>
    <textarea name = "content" cols = "80" rows = "10" required></textarea>
    <!--게시글 내용 입력 area (board 테이블 comment 컬럼)-->
    <br><br>
    <input type = "submit" value = "저장"/>
    <!--작성 완료 버튼-->
  </form>
</body>
</html>
