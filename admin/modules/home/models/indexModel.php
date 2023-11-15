<?php
function list_order() //Lấy danh sách đơn hàng
{
    $sql = db_fetch_array("SELECT * FROM `tb_orders`");
    return $sql;
}

function total_order_price($date) //Lấy tống số doanh thu trong ngày
{
    $sql = db_fetch_row("SELECT SUM(`total_price`) as `price` FROM `tb_orders` WHERE `time` LIKE '%{$date}%'");
    return $sql;
}

function list_customer() //Danh sách khách người
{
    $sql = db_fetch_array("SELECT * FROM `tb_customers`");
    return $sql;
}

function list_product()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng' ");
    return $sql;
}
