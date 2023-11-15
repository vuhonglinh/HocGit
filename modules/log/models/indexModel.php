<?php

function check_login($username, $password)//Kiểm tra tài khoản tồn tại mới login
{
    global $conn;
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `username` = '$username' AND`password`= '$password' AND `is_active`= '1' ");
    if ($sql > 0) {
        return true;
    }
    return false;
}
function active_users($active_token)//Kích hoạt tài khoản đăng ký
{
    db_update('tb_customers', array('is_active' => 1), "`active_token`='$active_token'");
}

function check_active_user($token)//Kiểm tra mã kích hoạt có đúng không
{
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `active_token` = '$token'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function check_active_user_vadid($token)//Kiểm tra đã kích hoạt chưa
{
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `active_token` = '$token' AND `is_active`= '0'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function delete_expired_users() //Xóa các users hết hạn kích hoạt
{
    $time = time();
    db_delete("tb_customers", "{$time} - `reg_date` >= 10 AND `is_active`= '0'");
}

function check_email($email)//Kiểm tra email đã tồn tại hay chưa để cho đổi mật khẩu
{
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `email` = '$email'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function update_reset_token($data, $email)
{
    db_update('tb_customers', $data, "`email`='$email'");
}

function check_reset_token($reset_token)//Kiểm tra mã xác minh để lấy lại mật khẩu
{
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `reset_token` = '$reset_token'");
    if ($sql > 0) {
        return true;
    }
    return false;
}

function update_password($data, $reset_token)
{
    db_update('tb_customers', $data, "`reset_token`='$reset_token'");
}

function add_customer($data_customer) //đăng ký
{
    db_insert('tb_customers', $data_customer);
}
