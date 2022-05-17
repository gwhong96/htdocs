<?php
function passwordCheck($_str)
{
    $pw = $_str;
    $num = preg_match('/[0-9]/u', $pw);
    $eng = preg_match('/[a-z]/u', $pw);
    $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$pw);

    if(strlen($pw) < 10 || strlen($pw) > 30)
    {
        return array(false,"비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 10자리 ~ 최대 30자리 이내로 입력해주세요.");
        exit;
    }

    if(preg_match("/\s/u", $pw) == true)
    {
        return array(false, "비밀번호는 공백없이 입력해주세요.");
        exit;
    }

    if( $num == 0 || $eng == 0 || $spe == 0)
    {
        return array(false, "영문, 숫자, 특수문자를 혼합하여 입력해주세요.");
        exit;
    }

    return array(true);
}
?>
