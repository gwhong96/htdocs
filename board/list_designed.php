<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/trig.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>QnA 게시판 | nasmedia</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
    ></script>
  <script src="./assets/js/init-alpine.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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
  <a href = "./list_designed.php">초기화</a>
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

          <th scope="col">히스토리</th>

				</tr>

			</thead>

			<tbody>

					<?php
          //검색
          if(isset($_GET['searchKeyword'])){
            $searchKeyword = $_GET['searchKeyword'];
            $searchOption = $_GET['option'];

            if($searchKeyword == '' || $searchKeyword == null){
              echo "검색어가 없습니다.";
              exit;
            }
            switch($searchOption){
              case 'title':
              case 'content':
              case 'writer':
              case 'torc':
                break;
              default:
                echo "검색 옵션이 없습니다.";
                exit;
                break;
            }
          }

            if(isset($_GET['page'])){
              $page = (int) $_GET['page'];//GET 형식을 통해 boardID전달
            }
            else{
              $page = 1;
            }

            $numView = 10;//한페이지에 표시할 게시물 갯수

            $firstLimitValue = ($numView * $page) - $numView;

            $sql = "SELECT boardID, title, m.nickName, b.regTime, b.views, b.disYN FROM board b JOIN member m ";
            $sql .= "ON (b.memberID = m.memberId) ";

            if(isset($_GET['searchKeyword'])){
              switch($searchOption){//검색 옵션별 where 쿼리
                case 'title':
                  $sql .= "WHERE title LIKE '%{$searchKeyword}%'";// 키워드가 속한 모든 내용
                  break;
                case 'content':
                  $sql .= "WHERE b.content LIKE '%{$searchKeyword}%'";
                  break;
                case 'writer':
                  $sql .= "WHERE m.nickName LIKE '%{$searchKeyword}%'";//작성자 검색
                  break;
                case 'torc':
                  $sql .= "WHERE b.title LIKE '%{$searchKeyword}%' OR b.content LIKE '%{$searchKeyword}%'";
                  break;
              }
                $sql .= " AND b.delYN = 'N' ";
            }else{
              $sql .= "WHERE b.delYN = 'N' ";
            }

            // $sql = "SELECT boardID, title, writer, regTime FROM board ";
            $sql .= "ORDER BY boardID ";
            $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";

            $result = $dbConnect->query($sql);//페이징이나 검색조건에 부합하는 값들만이 담

            $sqlCount = "SELECT count(boardID) FROM board WHERE delYN = 'N';";
            $totalCount = $dbConnect -> query($sqlCount);
            $totalCount = $totalCount -> fetch_array(MYSQLI_ASSOC);

            if($result){
              $dataCount = $result->num_rows;
              if($dataCount>0){
                for($i = 0; $i < $dataCount; $i++){
                  $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                  // $title = htmlspecialchars($memberInfo['title']);
                  echo "<tr>";
                  echo "<td>".($totalCount['count(boardID)']-$i-(($page-1)*10))."</td>";//총 게시글 수 boardID와 무관하게 역순정렬

                  if($memberInfo['disYN'] == 'N'){//비공개 일 시
                      echo "<td><a href = '../board/checkDisYN.php?boardID={$memberInfo['boardID']}'>";//게시글 비밀번호 확인 페이지
                      echo "<img src = '../img/lock.png' title = 'lock' width = '20' height ='20' />";
                  }else{
                      echo "<td><a href = '../board/view.php?boardID={$memberInfo['boardID']}'>";//상세보기 페이지 이동링크
                  }
                  echo $memberInfo['title'];
                  echo "</a></td>";
                  echo "<td>{$memberInfo['nickName']}</td>";
                  echo "<td>{$memberInfo['regTime']}</td>";
                  echo "<td>{$memberInfo['views']}</td>";
                  echo "<td><a href='history.php?boardID={$memberInfo['boardID']}' target = '_blank' onclick='window.open(this.href,'팝업창','width=100, height=100');'>log<a/></td>";
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
    include $_SERVER['DOCUMENT_ROOT'].'../board/paging.php';
    include $_SERVER['DOCUMENT_ROOT'].'../board/search.php';
   ?>
</body>
</html>
