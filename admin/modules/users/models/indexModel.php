<?php
function update_password_reset($username, $data)
{
    db_update('tb_admin', $data, "`username`='$username'");
}

function exits_password($password)
{
    $username = user_login();
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `username` = '$username' AND `password` = '$password'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
function update_user_login($username, $data)
{
    db_update("tb_admin", $data, "`username` = '$username'");
}
function get_user_by_username($username)
{
    $sql = db_fetch_row("SELECT * FROM `tb_admin` WHERE `username` = '$username' ");
    if (!empty($sql))
        return $sql;
}

function exits_active($token)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `active_token` = '$token'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function check_login($username, $password)
{
    global $conn;
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `username` = '$username' AND`password`= '$password'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
function active_users($active_token)
{
    db_update('tb_admin', array('is_active' => 1), "`active_token`='$active_token'");
}

function check_active_user($token)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `active_token` = '$token'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function check_active_user_vadid($token)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `active_token` = '$token' AND `is_active`= '0'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function check_email($email)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `email` = '$email'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
function update_reset_token($data, $email)
{
    db_update('tb_admin', $data, "`email`='$email'");
}

function check_reset_token($reset_token)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `reset_token` = '$reset_token'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function update_password($data, $reset_token)
{
    db_update('tbl_users', $data, "`reset_token`='$reset_token'");
}
