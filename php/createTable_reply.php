<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php/108-2-connectDB.php';

    $sql = "CREATE TABLE reply(";
    $sql .= "replyID int primary key not null auto_increment comment '댓글 인덱스',";
    $sql .= "boardID INT not null comment '게시글 고유번호 외래키',";
    $sql .= "replyDEPTH int(10) not null comment '댓글 계층',";
    $sql .= "replyGROUP int(10) not null comment '댓글 종속 그룹',";
    $sql .= "replyDATE DATETIME not null comment '댓글 작성 일시',";
    $sql .= "foreign key (boardID) references board(boardID) on update cascade on delete restrict)";
    $sql .= "charset = utf8 comment = '댓글 테이블';";

    $res = $dbConnect->query($sql);


    if($res){
      echo "테이블 생성 완료";
    }
    else{
      echo "테이블 생성 실패";
    }

 ?>
