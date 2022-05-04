<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php/108-2-connectDB.php';

    $sql = "CREATE TABLE board(";
    $sql .= "boardID int primary key not null auto_increment comment '게시글 고유번호',";
    $sql .= "name varchar(10) not null comment '게시글 작성자',";
    $sql .= "memberID int(10) unsigned not null,";
    $sql .= "title varchar(30) not null comment '게시글 제목',";
    $sql .= "boardPW varchar(20) comment '게시글 비밀번호',";
    $sql .= "comment longtext not null comment '게시글 내용',";
    $sql .= "boardDATE datetime not null comment '게시글 올린 날짜&시각',";
    $sql .= "seen int comment '게시글 조회수',";
    $sql .= "foreign key (memberID) references member(memberID) on update cascade on delete restrict)";
    $sql .= "charset = utf8 comment = '게시글 정보 테이블';";

    $res = $dbConnect->query($sql);


    if($res){
      echo "테이블 생성 완료";
    }
    else{
      echo "테이블 생성 실패";
    }

 ?>
