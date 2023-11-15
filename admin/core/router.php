<?php
if (!isset($_SESSION['is_admin_login']) && get_action() != "login") {
    redirect("?mod=log&action=login");
} else {
    $path = MODULESPATH . "/" . get_model() . "/" . "controllers" . "/" . get_controller() . "Controller.php";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại {$path}";
    }
    $action = get_action() . "Action";
    construct();
    call_function(array($action));
}
