<?php
session_start();
ob_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

$config['base_url'] = "http://localhost/Du-an-1/autosmart/admin/";

$config['default_model'] = "home";
$config['default_controller'] = "index";
$config['default_action'] = "index";
