<?php
require_once('./database_connect.php');
function logged_in($f_name,$email,$sesson_id)
{
    $conn=openCon();
    $ip=get_client_ip();
    $sql="INSERT INTO logged_in (f_name,email,session_id,ip) VALUES ('$f_name','$email','$sesson_id','$ip')" ;
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
function logout($email)
{
    $conn = openCon();
    $sql="UPDATE logged_in  SET state='1' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        return "1";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>