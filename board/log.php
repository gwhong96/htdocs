<?php

function fn_logSave($log){ //로그내용 인자
        $logPathDir = "/www/_log";  //로그위치 지정

        $filePath = $logPathDir."/".date("Y")."/".date("n");
        $folderName1 = date("Y"); //폴더 1 년도 생성
        $folderName2 = date("n"); //폴더 2 월 생성

        if(!is_dir($logPathDir."/".$folderName1)){
            mkdir($logPathDir."/".$folderName1, 0777);
        }

        if(!is_dir($logPathDir."/".$folderName1."/".$folderName2)){
            mkdir(($logPathDir."/".$folderName1."/".$folderName2), 0777);
        }

            $log_file = fopen($logPathDir."/".$folderName1."/".$folderName2."/".date("Ymd").".txt", "a");
            fwrite($log_file, $log."\r\n");
            fclose($log_file);
    }
?>
