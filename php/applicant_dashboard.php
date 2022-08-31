<?php
if (isset($_GET["ref"])) {
    $req = $_GET["ref"];
    if ($req == "app") {
        include($_SERVER["DOCUMENT_ROOT"] . "/php/get_applications.php");
    }
}