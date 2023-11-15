<?php
$path = MODULESPATH."/". get_model() ."/". "controllers" ."/". get_controller() . "Controller.php";

if (file_exists($path)) {
    require "$path";
} else {
    echo "Không tồn tại {$path}";
}

$action = get_action() . "Action";
construct();//Dùng chung
call_function(array($action));
