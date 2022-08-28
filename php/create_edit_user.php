<?php
require_once("./database_connect.php");
function create_user($email, $f_name, $l_name, $psw_hash)
{
    $conn = openCon();
    $sql = "INSERT INTO ehmrs_users (f_name,l_name,email,psw_hash,user_state,dashboard_type,email_verify) VALUES ('$f_name','$l_name','$email','$psw_hash','applicant','0','0')";
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
function find_user($email)
{
    $conn = openCon();
    $sql = "SELECT f_name FROM ehmrs_users WHERE email='$email' || emp_code='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return 1;
        }
    } else {
        return 0;
    }
}

function get_email($email)
{
    $conn = openCon();
    $sql = "SELECT email FROM ehmrs_users WHERE email='$email' || emp_code='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['email'];
        }
    } else {
        return 0;
    }
}

function login($email, $psw_hash)
{
    $conn = openCon();
    $sql = "SELECT f_name FROM ehmrs_users WHERE (email='$email' || emp_code='$email') && psw_hash='$psw_hash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row["f_name"];
        }
    } else {
        return 0;
    }
}

function check_email_verify($email)
{
    $conn = openCon();
    $sql = "SELECT email_verify FROM ehmrs_users WHERE email='$email' || emp_code='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['email_verify'];
        }
    } else {
        return 0;
    }
}