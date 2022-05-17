<!-- 검색 -->
<?php
include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
// include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';

  $searchKeyword = $dbConnect -> real_escape_string($_GET['searchKeyword']);//real_escape_string = injection 방지
  $searchOption = $dbConnect -> real_escape_string($_GET['option']);

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

  $sql = "SELECT b.boardID, b.title, m.nickName, b.regTime, b.views FROM board b ";
  $sql .= "JOIN member m on (m.memberID = b.memberID) ";

  switch($searchOption){
    case 'title':
      $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";// 키워드가 속한 모든 내용
      break;
    case 'content':
      $sql .= "WHERE b.content LIKE '%{$searchKeyword}%'";
      break;
    case 'writer':
      $sql .= "WHERE m.nickName LIKE '%{$searchKeyword}%'";//작성자 검색
      break;
    // case 'tandc':
    //   $sql .= "WHERE b.title LIKE '%{$searchKeyword}%' AND b.content LIKE '%{$searchKeyword}%'";
    //   break;
    case 'torc':
      $sql .= "WHERE b.title LIKE '%{$searchKeyword}%' OR b.content LIKE '%{$searchKeyword}%'";
      break;
  }

  $result = $dbConnect -> query($sql);
  if($result){
    $dataCount = $result -> num_rows;
  }
  else{
    echo "오류발생 - 관리자 문의";
    exit;
  }

 ?>

<!doctype html>
<html>
<head>
  <title>검색 결과</title>
  <link rel="stylesheet" href="./css/sandstone.css">
  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./css/board.css" />
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body>
  <a href = "./write.php">글 작성하기</a>
  <a href = "./signOut.php">로그아웃</a>
	<article class="boardArticle">

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
          if($dataCount>0){
            for($i = 0; $i < $dataCount; $i++){
              $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
              echo "<tr>";
              echo "<td>".$memberInfo['boardID']."</td>";
              echo "<td><a href = '../board/view.php?boardID={$memberInfo['boardID']}'>";//상세보기 페이지 이동링크
              echo "{$memberInfo['title']}</a></td>";
              echo "<td>".$memberInfo['nickName']."</td>";
              echo "<td>{$memberInfo['regTime']}</td>";
              echo "</tr>";
              }
            }else{
              echo "<tr><td colspan = '4'> {$searchKeyword}를 포함하는 게시글이 없습니다. </td></tr>";
            }
        ?>
      </tbody>
    </table>
  </body>
  </html>
