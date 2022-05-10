<?php

	// require_once("../dbconfig.php");
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>QnA 게시판 | nasmedia</title>
  <link rel="stylesheet" href="./css/sandstone.css">
	<link rel="stylesheet" href="./css/normalize.css" />
	<link rel="stylesheet" href="./css/board.css" />
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <style>
table.type11 { border-collapse: separate; border-spacing: 1px; text-align: center; line-height: 1.5; margin: 20px 10px;}
table.type11 th { width: 155px; padding: 10px; font-weight: bold; vertical-align: top; color: #fff; background: #ce481f ;}
table.type11 td { width: 155px; padding: 10px; vertical-align: top; border-bottom: 1px solid #ccc; background: #eee;}
table.type11 td:hover {  background: #555;}

</style>
</head>

<body>

  <a href = "./write.php">글 작성하기</a>
  <a href = "./signOut.php">로그아웃</a>
	<article class="boardArticle">

		<h3>QnA</h3>

		<table class="type11" border="1" style="" id=asdasdasd>

			<caption class="readHide">QnA</caption>

			<thead>

				<tr>

					<th scope="col" class="no">번호</th>

					<th scope="col" class="title">제목</th>

					<th scope="col" class="author">작성자</th>

					<th scope="col" class="date">작성일</th>

					<th scope="col" class="hit">조회수</th>

				</tr>

			</thead>

			<tbody>

					<?php

            if(isset($_GET['page'])){
              $page = (int) $_GET['page'];//GET 형식을 통해 boardID전달
            }
            else{
              $page = 1;
            }

            $numView = 10;//한페이지에 표시할 게시물 갯수

            $firstLimitValue = ($numView * $page) - $numView;

            $sql = "SELECT boardID, title, member.nickName, board.regTime, board.views FROM board JOIN member ";
            $sql .= "ON board.memberID = member.memberId ";
            $sql .= "WHERE board.delYN = 'N' ";
            // $sql = "SELECT boardID, title, writer, regTime FROM board ";
            $sql .= "ORDER BY boardID ";
            $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";

            $result = $dbConnect->query($sql);

            if($result){
              $dataCount = $result->num_rows;

              if($dataCount>0){
                for($i = 0; $i < $dataCount; $i++){
                  $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                  // $title = htmlspecialchars($memberInfo['title']);

                  echo "<tr>";
                  echo "<td>".$memberInfo['boardID']."</td>";
                  echo "<td><a href = '../board/view.php?boardID={$memberInfo['boardID']}'>";//상세보기 페이지 이동링크
                  // echo $title;
                  echo $memberInfo['title'];
                  echo "</a></td>";
                  echo "<td>{$memberInfo['nickName']}</td>";
                  // echo "<td><script>alert('asdad')</script></td>";
                  echo "<td>{$memberInfo['regTime']}</td>";
                  echo "<td>{$memberInfo['views']}</td>";
                  echo "</tr>";
                }
              }else{
                echo "<tr><td colspan = '4'> 게시글이 없습니다. </td></tr>";
              }
            }
					?>


			</tbody>

		</table>

	</article>

  <?php
    include $_SERVER['DOCUMENT_ROOT'].'../board/nextPage.php';
    include $_SERVER['DOCUMENT_ROOT'].'../board/search.php';
   ?>

</body>

</html>
