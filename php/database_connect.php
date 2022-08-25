<?php
function openCon()
{
    $dbhost = "localhost";
    $dbuser = "connection";
    $dbpass = "ork9Ld-dB7A3p(6M";
    $db = "storiyaan_ehmrs_users";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
return $conn;
}

function closeCon($conn)
{
$conn -> close();
}
?>