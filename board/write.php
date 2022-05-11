<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

 ?>

 <!doctype html>
 <html>
 <head>
</head>
<body>
  <?php
  if(isset($_GET['boardID'])){
      echo "게시글 수정";
      $boardID = $_GET['boardID'];
      $sql = "select * from board where boardID = {$boardID}";
      $result = $dbConnect -> query($sql);
      $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);

   ?>
   <form name = "boardWrite" method = "post" action = "./write_ok.php?boardID=<?= $boardID ?>">
     제목
     <br>
     <input type = "text" name = "title" required value = "<?=$boardInfo['title']?>"></input>
     <br><br>
     내용
     <br>
     <textarea name = "content" cols = "80" rows = "10" required><?=$boardInfo['content']?></textarea>
     <br><br>
     비공개
     <input type = "checkbox" name = "disYN" value = "N">
     비밀번호 <input type = "text" name = "boardPW">
     <br><br>
     <input type = "submit" value = "저장"/>
     <!--작성 완료-->
   </form>
   <?php
 }else{
   echo "게시글 작성";
    ?>
  <form name = "boardWrite" method = "post" action = "./write_ok.php">
    <br>
    제목
    <br>
    <input type = "text" name = "title" required/>
    <br><br>
    내용
    <br>
    <textarea name = "content" cols = "80" rows = "10" required></textarea>
    <br><br>
    비공개
    <input type = "checkbox" name = "disYN" value = "N">
    비밀번호 <input type = "text" name = "boardPW">
    <br><br>
    <input type = "submit" value = "저장"/>
  </form>
<?php } ?>


</body>
</html>
