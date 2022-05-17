<!-- 게시글 비밀번호 입력 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
 ?>

 <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
 <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="/js/jquery-ui.js"></script>
 <script type="text/javascript">
 	$(function(){
 		$("#writepass").dialog({
 		 	modal:true,
 		 	title:'비밀글입니다.',
 		 	width:400,
 	 	});
 	});
 </script>

 <?php
  $boardID = $_GET['boardID'];
  $sql = "SELECT boardPW FROM board WHERE boardID = '{$boardID}'";//해당 게시물에 대한 비밀번호 db에서 불러오기
  $result = $dbConnect -> query($sql);
  $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
  ?>

<div id='writepass'>
	<form action="" method="post">
 		<p>비밀번호<input type="text" name="checkPW" /> <input type="submit" value="확인" /></p>
 	</form>
</div>

<?php
  $boardPW = $boardInfo['boardPW'];
	 	if(isset($_POST['checkPW']))
	 	{
	 		$checkPW = $_POST['checkPW']; // $pwk변수에 POST값으로 받은 pw_chk를 넣습니다.
      $checkPW = hash('sha256', 'nasmedia'.$checkPW);//게시글 비밀번호 해시암호화
			if($boardPW == $checkPW) //다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
			{?>
				<script type="text/javascript">location.replace("view.php?boardID=<?php echo $boardID; ?>");</script><!-- pwk와 bpw값이 같으면 view.php로 보내고 -->
      <?php
			}else{
        ?>
				<script type="text/javascript">alert('비밀번호가 틀립니다');</script><!--- 아니면 비밀번호가 틀리다는 메시지를 보여줍니다 -->
			<?php }
    }
 ?>
