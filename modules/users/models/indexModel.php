<?php
function get_user_by_id($username) //Lấy thông tin user
{
    $sql = db_fetch_row("SELECT * FROM `tb_customers` WHERE `username` = '$username'");
    return $sql;
}

function update_user($username, $data_update) //Cập nhật thông tin user
{
    db_update("tb_customers", $data_update, "`username` = '$username'");
}

function list_order($username) //Lấy danh sachs đặt hàng
{
    $sql = db_fetch_array("SELECT * FROM `tb_orders` WHERE `username` = '$username'");
    return $sql;
}

function exits_password($password)
{
    $username = user_login();
    $sql = db_num_rows("SELECT * FROM `tb_customers` WHERE `username` = '$username' AND `password` = '$password'");
    if ($sql > 0) {
        return true;
    }
    return false;
}
function update_password_reset($username, $data)
{
    db_update('tb_customers', $data, "`username`='$username'");
}

function get_list_chat_by_id($id)
{
    $sql = db_fetch_array("SELECT * FROM `tb_messages` WHERE `customer_id` = {$id}");
    return $sql;
}
function add_chat($data) //Thêm nọi dung cuộc trò chuyện
{
    db_insert("tb_messages", $data);
}
