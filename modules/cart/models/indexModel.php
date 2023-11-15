<?php
function add_cart($id, $num_order)
{
    add_product_put_cart($id, $num_order);
    get_list_buy_cart();
    redirect("gio-hang.html");
}
function delete_cart($id)
{
    unset($_SESSION['cart']['buy'][$id]);
    update_cart();
    redirect("gio-hang.html");
}

function cancel_purchase($id, $data_delete) //Khách hủy thao tác mua
{
    $total = db_fetch_row("SELECT * FROM `tb_products` WHERE `product_id` = $id");
    $result = $total['quantity'] + $data_delete;
    $data_update = [
        'quantity' => $result,
    ];
    db_update("tb_products", $data_update, "`product_id` = '$id'");
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
