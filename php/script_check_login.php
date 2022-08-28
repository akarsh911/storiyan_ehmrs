<?php
if (isset($_COOKIE['cookie']) && $key = $_COOKIE["key"] != "undefined" && $key != null) {
    $key = str_replace(' ', '', $key);
    if ($key == "" || $key == null) {
    } else {
        chck($key);
    }
} else {
    echo "0";
}


function chck($key)
{
    require_once("./login_logout_user.php");
    echo check_log_in($key);
}
include("../html/forgot_psw.html");