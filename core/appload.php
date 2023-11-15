<?php
defined("FANDA") or exit("Không tồn tại đường dẫn");

require CONFIGPATH .  "/" . "autoload.php";
require CONFIGPATH .  "/" . "config.php";
require CONFIGPATH .  "/" . "database.php";
require CONFIGPATH .  "/" . "email.php";
require COREPATH .  "/" . "base.php";


if (is_array($autoload)) {
    foreach ($autoload as $key => $value) { //Key : Lib, helper
        if (!empty($value)) {
            foreach ($value as $item) { //Nếu không trống bên trong
                load($key, $item); //Required ra để sử dụng
            }
        }
    }
}

db_connect($db);

require COREPATH .  "/" . "router.php";
