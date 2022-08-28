<?php
function check_login()
{
    if (isset($_COOKIE['key']) &&  $_COOKIE["key"] != "undefined" && $_COOKIE["key"]  != null) {
        $key = $_COOKIE["key"];
        $key = str_replace(' ', '', $key);
        if ($key == "" || $key == null) {
            return false;
        } else {
            if (chck($key)) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}


function chck($key)
{
    require_once($_SERVER['DOCUMENT_ROOT'] . '/php/login_logout_user.php');

    if (check_log_in($key) == 1)
        return true;
    else
        return false;
}