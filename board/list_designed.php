<?php

	// require_once("../dbconfig.php");
  include $_SERVER['DOCUMENT_ROOT'].'../board/connectDB.php';
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8" />

	<title>QnA 게시판 | nasmedia</title>

	<link rel="stylesheet" href="./css/normalize.css" />

	<link rel="stylesheet" href="./css/board.css" />

</head>

<body>

  <a href = "./write.php">글 작성하기</a>

	<article class="boardArticle">

		<h3>QnA</h3>

		<table>

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
              $page = (int) $_GET['page'];
            }
            else{
              $page = 1;
            }

            $numView = 10;//한페이지에 표시할 게시물 갯수

            $firstLimitValue = ($numView * $page) - $numView;

            $sql = "SELECT boardID, title, name, regTime FROM board ";
            $sql .= "ORDER BY boardID ";
            $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";

            $result = $dbConnect->query($sql);

            if($result){
              $dataCount = $result->num_rows;

              if($dataCount>0){
                for($i = 0; $i < $dataCount; $i++){
                  $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                  echo "<tr>";
                  echo "<td>".$memberInfo['boardID']."</td>";
                  echo "<td><a href = '../board/view.php?boardID={$memberInfo['boardID']}'>";
                  echo $memberInfo['title'];
                  echo "</a></td>";
                  echo "<td>{$memberInfo['name']}</td>";
                  echo "<td>{$memberInfo['regTime']}</td>";
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
