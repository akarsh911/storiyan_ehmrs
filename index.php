<?php
$type = $_GET["type"];

if ($type == "login" || $type == "Login") {
    virtual('./html/template.html');
    virtual('./html/login_set.html');
} else if ($type == "verify") {
    virtual('./html/template.html');
    virtual('./html/verify_box.html');
} else if ($type == "verify_error") {
    virtual('./html/template.html');
    virtual('./html/verification_failed.html');
} else if ($type == "verify_success") {
    virtual('./html/template.html');
    virtual('./html/verification_success.html');
}