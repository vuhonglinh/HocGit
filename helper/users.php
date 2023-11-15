<?php


function is_login()
{
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

function user_login()
{
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}
function info_login($key = "fullname")
{
    if (isset($_SESSION['is_login'])) {
        $user_login = $_SESSION['user_login'];
        $sql = db_fetch_row("SELECT * FROM `tb_customers` WHERE `username` = '$user_login'");
        return $sql[$key];
    }
    return false;
}
