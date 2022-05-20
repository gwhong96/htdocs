<?php

function logCheck($type){

  $hTime = date("Y-m-d H:i:s");

  $sql  = "INSERT INTO boardhistory (type, boardID, delYN, title, boardPW, content, disYN, historyTime) ";
  $sql .= "VALUES (?,?,?,?,?,?,?,?)";

  $query = $dbConnect -> prepare($sql);
  $query -> bind_param('sissssss',$type, $boardID, $delYN, $title, $boardPW, $content, $disYN, $hTime);
  $result = $query -> execute();

}

 ?>




 <!-- insert into log_table (a,b,c,yn, type) select a,b,c,'y','del' table where table_id = 1 -->
