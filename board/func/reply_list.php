<?php

function reply_list($rID){

  $list_reply = '';

  $sql = "SELECT * FROM reply WHERE replyPID = {$rID}";
  $result = $dbConnect -> query($sql);
  $replyInfo = $result -> fetch_array(MYSQLI_ASSOC);
  $dataCount = $result -> num_rows;

  if($dataCount != 0){//대상 댓글의 하위 댓글이 존재할 때
    $list_reply .= "{$replyInfo['replyID']}"
    reply_list($replyInfo['replyID']);
  }else{//하위 대글이 없을 때
    return $list_reply;
  }

}

 ?>
