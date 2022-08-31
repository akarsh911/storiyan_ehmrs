<?php
function create_application($email, $f_name, $l_name)
{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/php/database_connect.php");
    $conn = openCon();
    $refid = gen_uuid();
    $sql = "INSERT INTO ehmrs_application (f_name,l_name,email,step,status,id,app_type) VALUES ('$f_name','$l_name','$email','1','Application Incomplete','$refid','New Applicant')";
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
function get_applications($email)
{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/php/database_connect.php");
    $conn = openCon();
    $data = array();
    $count = 1;
    $sql = "SELECT f_name,l_name,step,status,id,app_date,app_type FROM ehmrs_application WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$count] = $row;
        }
        $data["total"] = $count;
        return json_encode($data, JSON_PRETTY_PRINT);
    } else {
        return 0;
    }
}


function edit_application_stg2($email, $id, $phno, $pin, $city, $state)
{
    $conn = openCon();
    $sql = "UPDATE ehmrs_application  SET ph_no='$phno',pin_code='$pin',city='$city',state='$state',step='2' WHERE email='$email' AND id='$id'";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        return "1";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}


function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}