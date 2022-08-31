<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/create_edit_application.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/script_check_login.php');
$tel = $_POST["tel"];
$pin = $_POST["pin"];
$city = $_POST["city"];
$state = $_POST["state"];
$id = $_GET["id"];
$email = get_log_in_email_address();
$err = 0;
$vals = array();
$tel_json = array();
$tel_json["val"] = $tel;
$tel_json["err"] = check_telephone($tel);

$vals["tel"] = $tel_json;
if (!check_telephone($tel)) {
    $err++;
}

$pin_json = array();
$pin_json["val"] = $pin;
$pin_json["err"] = check_pin($pin);
$vals["pin"] = $pin_json;
if (!check_pin($pin)) {
    $err++;
}
$city_json = array();
$city_json["val"] = $city;
$city_json["err"] = check_city($city);
$vals["city"] = $city_json;
if (!check_city($city)) {
    $err++;
}
$state_json = array();
$state_json["val"] = $state;
$state_json["err"] = check_state($state);
$vals["state"] = $state_json;
if (check_state($state) != 1) {
    $err++;
}


function  check_telephone($phone)
{
    if (preg_match('/^[0-9]{10}+$/', $phone)) {
        return true;
    } else {
        return false;
    }
}

function check_pin($pin)
{

    if (preg_match('/^[0-9]{6}+$/', $pin)) {
        return true;
    } else {
        return false;
    }
}

function check_city($pin)
{

    if (preg_match('/^[0-9a-zA-z ]*$/', $pin)) {
        return true;
    } else {
        return false;
    }
}
function check_state($pin)
{

    if (preg_match('/^[0-9a-zA-z ]*$/', $pin)) {
        return true;
    } else {
        return false;
    }
}

echo $err;
if ($err == 0) {

    $resp = "";

    if ($resp = edit_application_stg2($email, $id, $tel, $pin, $city, $state) == 1) {
        echo "Success Creating Databse";
        //TODO: redirect to login page with message
    } else {
        echo $resp;
    }
} else {
    echo "<script> sessionStorage.setItem('err_data', `" . json_encode($vals, JSON_PRETTY_PRINT) . "`);</script>";
    //echo '<script>window.onload = (event) => {location.replace("../html/onboard.html")};</script>';
}