<?php

include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
include $_SERVER['DOCUMENT_ROOT'].'./board/checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

// DB를 정의합니다. 여기서는 DB 클래스 파일을 include해서 사용했습니다.

$csv_dump = "";

// 내보낼 데이터를 가져옵니다.

$sql  = "SELECT b.boardID, m.nickName, b.title, b.content, b.regTime, b.lastUpdate, b.disYN ";
$sql .= "FROM board b JOIN member m on (m.memberID = b.memberID) WHERE delYN = 'N' ORDER BY boardID desc";

$result = $dbConnect -> query($sql);

// CSV 파일 최상단에 표기 할 내용입니다.

$csv_dump .= "ID, Writer, Title, content, regTime, LastUpdate, disYN,";
$csv_dump .= "\r\n";

// while 로 데이터를 변수에 쓸어 넣습니다 -_-;
while ($row = $result->fetch_array()) {

    // CSV저장 시 CR+LF 및 , 표시가 있으면 안되므로 치환시킵니다.
    // $row[mail_txt] = str_replace("\r\n","",$row[mail_txt]);
    // $row[mail_txt] = str_replace(","," ",$row[mail_txt]);

    // 행 값을 csv_dump 에 쓸어담습니다 -_-;

    $csv_dump .= $row['boardID'].",";

    $csv_dump .= $row['nickName'].",";

    $csv_dump .= str_replace(",", "", $row['title']).",";

    $csv_dump .= preg_replace('/\r\n|\r|\n|,/', '', $row['content']).",";

    $csv_dump .= $row['regTime'].",";

    $csv_dump .= $row['lastUpdate'].",";

    $csv_dump .= $row['disYN'].",";

    $csv_dump .= "\r\n";

} // while문 종료

// CSV 파일로 저장합니다. 파일명을 날짜를 붙여 생성합니다.

$date = date("YmdHi");

$filename = "csvoutput_".$date.".csv";

header( "Content-type: application/vnd.ms-excel;charset=KSC5601" );

header("Content-Disposition: attachment; filename=$filename");

header( "Content-Description: PHP4 Generated Data" );

// echo "\xEF\xBB\xBF"; -> BOM때문에 첫글자 깨집니다.
$csv = mb_convert_encoding($csv_dump, "CP949", "UTF-8");
echo $csv;





?>
