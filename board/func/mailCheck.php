<?php

function mailCheck($_str)
{
    if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_str) == false)
    {
        return false;
        // array(false, "올바른 이메일 주소를 입력해주세요.");
    }
    else
    {
        return true;
        // return array(true);
    }
}

 ?>
