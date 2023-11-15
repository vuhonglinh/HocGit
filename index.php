<?php
$path_folder = dirname(__FILE__);
define("FANDA", $path_folder);
//Tạo đường dẫn đến cấu hình
$config_folder = "config";
define("CONFIGPATH", FANDA . "/" . $config_folder);
//
$core_folder = "core";
define("COREPATH", FANDA . "/" . $core_folder);
//
$helper_folder = "helper";
define("HELPERPATH", FANDA . "/" . $helper_folder);
//
$layout_folder = "layout";
define("LAYOUTPATH", FANDA . "/" . $layout_folder);
//
$lib_folder = "libraries";
define("LIBPATH", FANDA . "/" . $lib_folder);
//
$modules_folder = "modules";
define("MODULESPATH", FANDA . "/" . $modules_folder);

require COREPATH . "/" . "appload.php";
