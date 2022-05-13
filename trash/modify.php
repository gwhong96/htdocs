<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  $boardID = $_GET['boardID'];
	$sql = "select * from board where boardID = {$boardID}";
	$result = $dbConnect -> query($sql);
  $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
  //수정 이전, 기존의 데이터
 ?>

 <!doctype html>
 <html>
 <head>게시글 수정
   <script>
     function dis(){//수정 이전 공개 여부 확인
       YN = <?=$boardInfo?>
       if(YN = 'Y'){
         <input type = "radio" name = "disYN" value = "Y" checked>공개
         <input type = "radio" name = "disYN" value = "N">비공개
       }else{
         <input type = "radio" name = "disYN" value = "Y">공개
         <input type = "radio" name = "disYN" value = "N" checked>비공개
       }
     }
   </script>
</head>
<body>
  <form name = "boardWrite" method = "post" action = "./modify_ok.php?boardID=<?= $boardID ?>">
    제목
    <br>
    <input type = "text" name = "title" required value = "<?=$boardInfo['title']?>"></input>
    <br><br>
    내용
    <br>
    <textarea name = "content" cols = "80" rows = "10" required><?=$boardInfo['content']?></textarea>

    <br><br>

    공개 여부
    <input type = "radio" name = "disYN" value = "Y" checked>공개
    <input type = "radio" name = "disYN" value = "N">비공개
    <br><br>
    <input type = "submit" value = "저장"/>
    <!--작성 완료-->
  </form>
</body>
</html>
