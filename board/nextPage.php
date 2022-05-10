<?php

  $sql = "SELECT count(boardID) FROM board";//count (pk컬럼) = 전체 row의 갯수 = 전체 게시글
  $result = $dbConnect -> query($sql);

  $boardTotalCount = $result ->fetch_array(MYSQLI_ASSOC);//컬럼명으로 호출
  $boardTotalCount = $boardTotalCount['count(boardID)'];//전체 게시글 수

  $totalPage = ceil($boardTotalCount / $numView);//총 페이지 수 (ceil 올림)

  echo "<a href = './list_designed.php?page=1'>first</a>&nbsp;&nbsp;";

  if($page != 1){
    $previousPage = $page - 1;
    echo "<a href='./list_designed.php?page={$previousPage}'>prev</a>";
  }//이전 페이지 이동 링크

  $pageTerm = 5;//앞뒤 페이지 표시 갯수

  $startPage = $page - $pageTerm;
  //처음에 표시되는 페이지를 현재 페이지 기준으로 정해진 갯수만큼만 표시

  if($startPage < 1){
    $startPage = 1;
  }//시작페이지가 1보다 작을경우 1로 고정

  $lastPage = $page + $pageTerm;


  if($lastPage >= $totalPage){
    $lastPage = $totalPage;
  }//마지막 페이지 표시가 실제 페이지 최대 갯수보다 많을경우

  for($i = $startPage; $i < $lastPage; $i++){
    // $nowPageColor = 'unset';
    // if($i == $page){
    //   $nowPageColor = 'hotpink';
    // }
    echo "&nbsp <a href = './list_designed.php?page={$i}'>{$i}</a>";

  }



  if($page = $totalPage){//다음 페이지가 있다면

  }else{
    $nextPage = $page + 1;
    echo "&nbsp; <a href = './list_designed.php?page={$nextPage}'>next</a>";//다음페이지 버튼 활성화
  }


  echo "&nbsp;&nbsp;&nbsp;<a href = './list_designed.php?page={$totalPage}'>last</a>";


 ?>