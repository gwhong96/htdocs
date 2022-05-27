<!--목록-->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/func/trig.php';
?>

<!DOCTYPE html>
<html>
<style>
.th_sty {
  text-align: center;
}
</style>
<head>
	<meta charset="utf-8" />
	<title>QnA 게시판 | nasmedia</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="./css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./js/init-alpine.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
</head>
<body>

<h3><a href="./list.php"><img src="../img/logo.svg"/></a></h3>
<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Q&A</h4>
<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
  <button type="button" style="background : gray" class="items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./write.php';">게시글 작성</button>
  <button type="button" style="background : gray" class="items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signOut.php';">로그아웃</button>
  <button type="button" style="background : gray" class="items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signUpForm.php';">회원정보 수정</button>
  <div style="padding-left:100px; padding-right:100px" class="w-full overflow-x-auto">
		<table style = "width : 70%" class="w-full whitespace-no-wrap">
      <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="th_sty px-4 py-3">Number</th>
          <th class="px-4 py-3">Title</th>
          <th class="th_sty px-4 py-3">Writer</th>
          <th class="th_sty px-4 py-3">RegDate</th>
          <th class="th_sty px-4 py-3">Views</th>
          <th class="th_sty px-4 py-3">History</th>
        </tr>
      </thead>

			<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

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
              $page = (int) $_GET['page'];
            }
            else{
              $page = 1;
            }

            $numView = 10;//한페이지에 표시할 게시물 갯수

            $firstLimitValue = ($numView * $page) - $numView;

            $sql = "SELECT boardID, title, m.nickName, b.regTime, b.views, b.disYN FROM board b JOIN member m ";
            $sql .= "ON (b.memberID = m.memberId) ";

            $sqlCount = "SELECT count(boardID) FROM board b JOIN member m ";
            $sqlCount .= "ON (b.memberID = m.memberId) ";

            if(isset($_GET['searchKeyword'])){
              switch($searchOption){//검색 옵션별 where 쿼리
                case 'title':
                  $sql_param = "WHERE title LIKE '%{$searchKeyword}%'";// 키워드가 속한 모든 내용
                  break;
                case 'content':
                  $sql_param = "WHERE b.content LIKE '%{$searchKeyword}%'";
                  break;
                case 'writer':
                  $sql_param = "WHERE m.nickName LIKE '%{$searchKeyword}%'";//작성자 검색
                  break;
                case 'torc':
                  $sql_param = "WHERE b.title LIKE '%{$searchKeyword}%' OR b.content LIKE '%{$searchKeyword}%'";
                  break;
              }
                $sqlCount .= $sql_param." AND b.delYN = 'N' ";
                $sql .= $sql_param." AND b.delYN = 'N' ";

            }else{
              $sql .= "WHERE b.delYN = 'N' ";
              $sqlCount .= "WHERE b.delYN = 'N' ";
            }


            $sql .= "ORDER BY boardID ";
            $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";


            $result = $dbConnect->query($sql);//페이징이나 검색조건에 부합하는 값들만이 담

            // $sqlCount = "SELECT count(boardID) FROM board WHERE delYN = 'N' ";
            $totalCount = $dbConnect -> query($sqlCount);
            $totalCount = $totalCount -> fetch_array(MYSQLI_ASSOC);

            if($result){
              $dataCount = $result->num_rows;
              if($dataCount>0){
                for($i = 0; $i < $dataCount; $i++){
                  $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                  // $title = htmlspecialchars($memberInfo['title']);
                  echo "<tr class='text-gray-700 dark:text-gray-400'>";
                  echo "<td class='th_sty px-4 py-3'>";
                  echo "<div class='flex items-center text-sm'>";
                  echo "<div><p class='font-semibold'>";

                  echo ($totalCount['count(boardID)']-$i-(($page-1)*$numView))."</p></div>";
                  echo "</div></td>";//총 게시글 수 boardID와 무관하게 역순정렬

                  if($memberInfo['disYN'] == 'N'){//비공개 일 시
                      echo "<td class='th_sty px-4 py-3'><a href = '../board/checkDisYN.php?boardID={$memberInfo['boardID']}' style='float:left'>";//게시글 비밀번호 확인 페이지
                      echo "<img src = '../img/lock.png' title = 'lock' width = '20' height ='20' style='float:left'/>";
                  }else{
                      echo "<td class='px-4 py-3'><a href = '../board/view.php?boardID={$memberInfo['boardID']}'>";//상세보기 페이지 이동링크
                  }
                  echo $memberInfo['title'];
                  echo "</a></td>";
                  echo "<td class='th_sty px-4 py-3 text-sm'>{$memberInfo['nickName']}</td>";
                  echo "<td class='th_sty px-4 py-3 text-xs'>{$memberInfo['regTime']}</td>";
                  echo "<td class='th_sty px-4 py-3 text-sm'>{$memberInfo['views']}</td>";
                  echo "<td class='th_sty px-4 py-3 text-sm'><a href='history.php?boardID={$memberInfo['boardID']}' target = '_blank' onclick='window.open(this.href,'팝업창','width=100, height=100');'>log<a/></td>";
                  echo "</tr>";
                }
              }else{
                echo "<tr><td colspan = '4'> 게시글이 없습니다. </td></tr>";
              }
            }
					?>
			</tbody>
		</table>
  </div>


  <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800" style="text-align : center">
    <?php
      include $_SERVER['DOCUMENT_ROOT'].'../board/paging.php';
     ?>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'../board/search.php';?>
</div>
</body>
</html>