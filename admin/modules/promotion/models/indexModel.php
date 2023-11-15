<?php
function get_list_products() //Danh sách sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM tb_products 
    INNER JOIN tb_category ON tb_products.cat_id = tb_category.id WHERE NOT EXISTS ( SELECT * FROM product_promotion 
    WHERE tb_products.product_id = product_promotion.product_id ) AND tb_products.status = 'Đã đăng'");
    return $sql;
}
function add_promotion($data) //Add vào bảng khuyễn mãi
{
    $sql = db_insert("tb_promotions", $data);
    return $sql;
}

function add_product_promotion($data) //Add vào bảng product_promotion
{
    db_insert("product_promotion", $data);
}

function get_list_promotion($start, $num_rows, $status) //Lấy danh sách khuyễn mãi
{
    if (!empty($status)) {
        $status = "WHERE `status` = '{$status}'";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_promotions` {$status} LIMIT $start, $num_rows");
    return $sql;
}

function get_padding($num_rows)
{
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    $sql = null;
    $url = null;
    if (!empty($status)) {
        $url = "&status={$status}";
        $sql = "WHERE `status` = '{$status}'";
    }
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_promotions` {$sql} ") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=promotion&action=list_promotion{$url}&page={$page_prev}' title=''>&laquo;</a></li>";

    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-info text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item'><a class='page-link {$style}' href='?mod=promotion&action=list_promotion{$url}&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=promotion&action=list_promotion{$url}&page={$page_next}' title=''>&raquo;</a></li>";

    $padding .= "</ul>";
    return $padding;
}

function get_promotion_by_id($id) //Lấy khuyễn mãi bằng id
{
    $sql = db_fetch_row("SELECT * FROM `tb_promotions` WHERE `id` = {$id}");
    return $sql;
}

function get_list_product_promotion($id) //Lấy danh sách sản phẩm liên quan đến khuyễn mãi
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` 
    INNER JOIN `tb_category` ON tb_products.cat_id = tb_category.id 
    INNER JOIN `product_promotion` ON tb_products.product_id = product_promotion.product_id
    WHERE product_promotion.promotion_id = {$id}");
    return $sql;
}
