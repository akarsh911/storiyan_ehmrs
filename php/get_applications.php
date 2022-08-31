<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/php/script_check_login.php");
if (check_login()) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/php/create_edit_application.php");
    $email = get_log_in_email_address();
    $data = get_applications($email);
    $data = json_decode($data, true);
?>

<link href="../css/apllication.css" rel="stylesheet" />
<div class="app_box">
    <?php
        for ($i = 1; $i <= $data['total']; $i++) {
            $sm_ar = $data[$i];
        ?>
    <div class="app_container">
        <div class="app_wrapper">
            <div class="app_data"><span class="app_title">Application Type: </span> <?php echo $sm_ar["app_type"] ?>
            </div>
            <div class="app_data"><span class="app_title">Ref No: </span> <?php echo $sm_ar["id"] ?></div>
        </div>
        <div class="app_wrapper">
            <div class="app_data"><span class="app_title">Application Date: </span><?php echo $sm_ar["app_date"] ?>
            </div>
            <div class="app_data"><span class="app_title">Step: </span> <?php echo $sm_ar["step"] ?> / 5 Completed
            </div>
            <div class="app_data"><span class="app_title">Status: </span> <?php echo $sm_ar["status"] ?></div>
        </div>
        <hr>
        <div class="app_wrapper_right">
            <button class="incomplete_bt" onclick="">Complete Application</button>
        </div>
    </div>
    <?php
        }
        ?>

</div>

<?php
} else {
    echo "err";
}