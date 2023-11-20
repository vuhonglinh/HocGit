<?php

function check_login($username, $password)
{
    global $conn;
    $sql = db_num_rows("SELECT * FROM `tb_users` WHERE `username` = '$username' AND`password`= '$password'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

