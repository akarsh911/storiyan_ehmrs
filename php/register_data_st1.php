<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/php/create_edit_user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/create_edit_application.php');
$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$email = $_POST["email"];
$psw = $_POST["psw"];
$c_psw = $_POST["c_psw"];
$err = 0;
$vals = array();
$f_name_json = array();
$f_name_json["val"] = $f_name;
$f_name_json["err"] = check_name($f_name);
$vals["f_name"] = $f_name_json;
if (check_name($f_name) != 1) {
    $err++;
}

$l_name_json = array();
$l_name_json["val"] = $l_name;
$l_name_json["err"] = check_name($l_name);
$vals["l_name"] = $l_name_json;
if (check_name($l_name) != 1) {
    $err++;
}
$email_json = array();
$email_json["val"] = $email;
$email_json["err"] = check_mail($email);
$vals["email"] = $email_json;
if (check_mail($email) != 1) {
    $err++;
}
$psw_json = array();
$psw_json["val"] = $psw;
$psw_json["err"] = check_psw($psw);
$vals["psw"] = $psw_json;
if (check_psw($psw) != 1) {
    $err++;
}
$c_psw_json = array();
$c_psw_json["val"] = $c_psw;
$c_psw_json["err"] = check_c_psw($psw, $c_psw);
$vals["c_psw"] = $c_psw_json;
if (check_c_psw($psw, $c_psw) != 1) {
    $err++;
}
function check_name($name)
{
    $val = 1;
    if ($name != "" && $name != null && strlen($name) >= 3) {
        if (!preg_match("/^[a-zA-z]*$/", $name)) {
            $val = "Only alphabets and whitespace are allowed";
        }
    } else {
        $val = "Please Enter a valid Name";
    }

    return $val;
}

function check_mail($mail)
{
    $val = 1;
    if ($mail != "" && $mail != null && strlen($mail) >= 6) {
        if (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $mail)) {
            $val = "Please enter a valid Email Id";
        }
    } else {
        $val = "Please enter a valid Email Id";
    }
    return  $val;
}
function check_psw($pwd)
{
    $val = 1;
    if ($pwd != "" && $pwd != null && strlen($pwd) >= 6) {
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/', $pwd)) {
            $val = "Please enter a password with 7-16 characters , one lower & uppercase & one sp. character";
        }
    } else {
        $val = "Please enter a password with 7-16 characters , one lower & uppercase & one sp. character";
    }
    return  $val;
}
function check_c_psw($psw, $pwd)
{
    $val = 1;
    if ($pwd != "" && $pwd != null && strlen($pwd) >= 6) {
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/', $pwd)) {
            $val = "Please enter a password with 7-16 characters , one lower & uppercase & one sp. character";
        }
        if ($psw != $pwd) {
            $val = "Confirm Password Should Match";
        }
    } else {
        $val = "Confirm Password Should Match";
    }
    return  $val;
}


if (find_user($email) == 1) {
    $vals["used_email"] = true;
    $err++;
} else {
    $vals["used_email"] = false;
}
if ($err == 0) {

    $resp = "";
    if ($resp = create_user($email, $f_name, $l_name, $psw) == 1) {
        if ($resp = create_application($email, $f_name, $l_name) == 1) {
            echo "Success Creating Databse";
            //TODO: redirect to login page with message
        } else {
            echo $resp;
        }
    } else {
        echo $resp;
    }
} else {
    echo "<script> sessionStorage.setItem('err_data', `" . json_encode($vals, JSON_PRETTY_PRINT) . "`);</script>";
    echo '<script>window.onload = (event) => {location.replace("../html/onboard.html")};</script>';
}