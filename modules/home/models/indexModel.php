<?php
// function get_padding_phone($num_rows)
// {
//     $num_page = ceil(db_num_rows("SELECT * FROM `list_products` WHERE `cat_id` = '1' ") / $num_rows);
//     $padding = "";
//     $padding .= "<ul class='list-item clearfix'>";
//     for ($i = 1; $i <= $num_page; $i++) {
//         $padding .= "<li><a href='?mod=home&action=index&cat_id=1&page_phone={$i}'>{$i}</a></li>";
//     }
//     $padding .= "</ul>";
//     return $padding;
// }

// function get_padding_tablet($num_rows)
// {
//     $num_page = ceil(db_num_rows("SELECT * FROM `list_products` WHERE `cat_id` = '2' ") / $num_rows);
//     $padding = "";
//     $padding .= "<ul class='list-item clearfix'>";
//     for ($i = 1; $i <= $num_page; $i++) {
//         $padding .= "<li><a href='?mod=home&action=index&cat_id=1&page_tablet={$i}'>{$i}</a></li>";
//     }
//     $padding .= "</ul>";
//     return $padding;
// }

// function get_padding_laptop($num_rows)
// {
//     $num_page = ceil(db_num_rows("SELECT * FROM `list_products` WHERE `cat_id` = '3' ") / $num_rows);
//     $padding = "";
//     $padding .= "<ul class='list-item clearfix'>";
//     for ($i = 1; $i <= $num_page; $i++) {
//         $padding .= "<li><a href='?mod=home&action=index&cat_id=1&page_laptop={$i}'>{$i}</a></li>";
//     }
//     $padding .= "</ul>";
//     return $padding;
// }
function list_products()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng' ");
    return $sql;
}
function list_products_phone()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `cat_id` = 1 AND `status` = 'Đã đăng'");
    return $sql;
}

function list_products_tablet()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `cat_id` = 2 AND `status` = 'Đã đăng'");
    return $sql;
}
function list_products_latop()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `cat_id` = 3 AND `status` = 'Đã đăng'");
    return $sql;
}
function list_products_by_sales()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng' ORDER BY `sales` DESC LIMIT 0, 10 ");
    return $sql;
}

function list_sliders()
{
    $sql = db_fetch_array("SELECT * FROM `tb_sliders` WHERE `status` = 'Đã đăng'");
    return $sql;
}

function list_ads($data)
{
    $sql = db_fetch_row("SELECT * FROM `tb_ads` WHERE `ads_name` = '{$data}'");
    return $sql;
}

function  add_cart_ajax($id)
{
    add_product_put_cart($id, null);
    get_list_buy_cart();
}
