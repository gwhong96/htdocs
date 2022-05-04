<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php/108-2-connectDB.php';

    $sql = "CREATE TABLE member(";
    $sql .= "memberID int unsigned primary key auto_increment comment '회원 고유번호',";
    $sql .= "userID varchar(10) not null comment '회원 ID',";
    $sql .= "name varchar(10) not null comment '회원 이름',";
    $sql .= "password varchar(30) not null comment '회원 비밀번호',";
    $sql .= "phone varchar(13) not null comment '회원 전화번호',";
    $sql .= "email varchar(30) not null comment '회원 이메일',";
    $sql .= "birthday char(10) not null comment '회원 생일',";
    $sql .= "gender enum('m','w','x') default 'x' comment '고객 성별',";
    $sql .= "regDATE datetime not null comment '가입 일시')";
    $sql .= "charset = utf8 comment = '게시글 정보 테이블';";

    $res = $dbConnect->query($sql);


    if($res){
      echo "테이블 생성 완료";
    }
    else{
      echo "테이블 생성 실패";
    }

 ?>
