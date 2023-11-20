<?php
function cart_buy()
{
    if (isset($_SESSION['cart']['buy'])) {
        return $_SESSION['cart']['buy'];
    }
}

function cart_info()
{
    if (isset($_SESSION['cart']['info'])) {
        return $_SESSION['cart']['info'];
    }
}
function get_cart_by_id($id_color) //Lấy sản phẩm qua id
{
    $sql = db_fetch_row("SELECT * FROM `tb_color_variants` INNER JOIN `tb_products` ON tb_color_variants.product_id = tb_products.product_id
    INNER JOIN `tb_ram_variants` ON tb_color_variants.ram_id = tb_ram_variants.id WHERE tb_color_variants.id = '$id_color'");
    return $sql;
}

function add_product_put_cart($id_color, $qty) //Thêm vào giỏ hàng 
{
    $item = get_cart_by_id($id_color);
    if (empty($qty)) {
        $qty = 1;
    }
    // //TRừ sản phẩm trong Database khi mua hàng
    // $quantity = $item['quantity']; //Số sản phẩm trong giỏ hàng
    // $total_product = $quantity - $qty;
    // $data_quantity = [
    //     'quantity' => $total_product,
    // ];
    // db_update("tb_products", $data_quantity, "`product_id` = $id");
    // //
    // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
    if (isset($_SESSION['cart']['buy']) && array_key_exists($id_color, $_SESSION['cart']['buy'])) {
        $_SESSION['cart']['buy'][$id_color]['qty'] += $qty;
        $_SESSION['cart']['buy'][$id_color]['sub_total'] = $_SESSION['cart']['buy'][$id_color]['qty'] * $_SESSION['cart']['buy'][$id_color]['price'];
    } else {
        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
        $_SESSION['cart']['buy'][$id_color] = [
            'product_id' => $item['product_id'],
            'ram_id' => $item['ram_id'],
            'color_id' => $item['id'],
            'product_code' => $item['product_code'],
            'product_name' => $item['product_name'] . " " . $item['ram_name'] . " " . $item['color_name'],
            'price' => $item['price'] + $item['color_price'],
            'product_thumb' => $item['product_thumb'],
            'qty' => $qty,
            'sub_total' => ($item['price'] + $item['color_price']) * $qty,
        ];
    }
    update_cart();
}

function update_cart() //Cập nhật lại giỏ hàng
{
    $count = 0;
    $total = 0;
    if (isset($_SESSION['cart']['buy'])) {
        $count = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $count += $item['qty'];
            $total += $item['sub_total'];
        }
    }
    $_SESSION['cart']['info'] = [
        'count' => $count,
        'total' => $total,
    ];
}

function get_list_buy_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) { //Cập nhật lại và thêm url
            $item['url_delete'] = "?mod=cart&action=delete&id={$item['product_id']}";
        }
        return $_SESSION['cart']['buy'];
    }
    return false;
}
