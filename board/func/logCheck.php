<?php

function logCheck($type){//$type으로 del, up, ins 셋중 하나 받아오기

  $hTime = date("Y-m-d H:i:s");

  $sql  = "INSERT INTO boardhistory (type, boardID, delYN, title, boardPW, content, disYN, historyTime) ";
  $sql .= "VALUES (?,?,?,?,?,?,?,?)";

  $query = $dbConnect -> prepare($sql);
  $query -> bind_param('sissssss',$type, $boardID, $delYN, $title, $boardPW, $content, $disYN, $hTime);
  //delYN
  $result = $query -> execute();

}



 ?>



 insert into boardhistory (a,b,c,yn, type) select a,b,c,'y','del' from board where boardId = 1
