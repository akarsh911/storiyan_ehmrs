<?php $key = $_COOKIE["key"];
$key = str_replace(' ', '', $key);
if ($key == "" || $key == null) {
} else {
    chck($key);
}
function chck($key)
{
    require_once("./login_logout_user.php");
    echo check_log_in($key);
}