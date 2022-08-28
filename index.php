<?php
$type = $_GET["type"];

if ($type == "login" || $type == "Login") {
    require_once('./php/script_check_login.php');
    if (check_login()) {
        header("Location: /dashboard");
        exit();
    } else {
        virtual('./html/template.html');
        virtual('./html/login_set.html');
    }
} else if ($type == "verify") {
    virtual('./html/template.html');
    virtual('./html/verify_box.html');
} else if ($type == "verify_error") {
    virtual('./html/template.html');
    virtual('./html/verification_failed.html');
} else if ($type == "verify_success") {
    virtual('./html/template.html');
    virtual('./html/verification_success.html');
} else if ($type == "dashboard") {
    require_once('./php/script_check_login.php');
    if (check_login()) {
        virtual('./html/dashboard.html');
    } else {
        header("Location: /login");
        exit();
    }
    //virtual('./html/verification_success.html');
}