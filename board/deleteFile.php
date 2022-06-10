<?php

include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';
include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';


  $fileID = $_GET['fileID'];
  $boardID = $_GET['boardID'];
  $sql = "DELETE from upload_file WHERE fileID={$fileID}";

  $result = $dbConnect -> query($sql);
  echo "<script type='text/javascript'>alert('삭제 완료');window.location = './view.php?boardID={$boardID}';</script>";



?>
