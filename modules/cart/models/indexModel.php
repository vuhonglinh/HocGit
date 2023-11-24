<?php
function add_cart($id_color, $quantity)
{
    add_product_put_cart($id_color, $quantity);
    get_list_buy_cart();
}
function delete_cart($id) //Xóa sản phẩm trong giỏ hàng
{
    unset($_SESSION['cart']['buy'][$id]);
    update_cart();
    redirect("gio-hang.html");
}

function cancel_purchase($id) //Khách hủy thao tác mua xóa sản phẩm
{
    $color_var = db_fetch_row("SELECT * FROM `tb_color_variants` WHERE `id` = $id"); //Lấy số lượng biến thể trong database
    $quantity =  $color_var['quantity'] +  $_SESSION['cart']['buy'][$id]['qty'];
    $data_update = [
        'quantity' => $quantity,
    ];
    db_update("tb_color_variants", $data_update, "`id` = '$id'");
}

function update_again_quantity($id, $data) //Cập nhật lại giỏ hàng
{
    $total = db_fetch_row("SELECT * FROM `tb_products` WHERE `product_id` = $id");
    $qty = $data - $_SESSION['cart']['buy'][$id]['qty'];
    $result = $total['quantity'] - $qty;
    $data_update = [
        'quantity' => $result,
    ];
    db_update("tb_products", $data_update, "`product_id` = '$id'");
}

function delete_cart_all()
{
    unset($_SESSION['cart']['buy']);
    unset($_SESSION['cart']['info']);
    update_cart();
}
function add_order_buy($data)
{
    db_insert("tb_orders", $data);
}

function update_sales_product($data)
{
    foreach ($data as $item) {
        $sql = db_fetch_row("SELECT * FROM `tb_products` WHERE `product_id` = '{$item['product_id']}' ");
        $total = $sql['sales'] + $item['sales'];
        $star = [
            'sales' => $total
        ];
        db_update("tb_products", $star, "`product_id` = '{$item['product_id']}' ");
    }
}

function get_customer_innfo() //Lấy thông tin khách hàng
{
    $username = $_SESSION['user_login'];
    $sql = db_fetch_row("SELECT * FROM `tb_customers` WHERE `username` = '{$username}'");
    return $sql;
}
