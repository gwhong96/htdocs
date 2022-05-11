<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
 ?>

 <!doctype html>
 <html>
 <head>게시글 작성
</head>
<body>
  <form name = "boardWrite" method = "post" action = "./write_ok.php">
    <!-- method = post POST방식으로 데이터 전달 -->
    <br>
    제목
    <br>
    <input type = "text" name = "title" required/>
    <!-- required를 통해 null 방지 -->
    <!-- <br><br>
    작성자
    <br>
    <input type = "text" name = "name" required/> -->
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
    비공개
    <input type = "checkbox" name = "disYN" value = "N">
    비밀번호 <input type = "text" name = "boardPW">
    <br><br>
    <input type = "submit" value = "저장"/>
    <!--작성 완료-->

  </form>

</body>
</html>
