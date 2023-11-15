<?php
function list_product($cat_id, $name_product, $start, $num_rows, $select)
{
    $sql = "WHERE";
    if (!empty($select)) {
        if ($select == 1) {
            $select = "ORDER BY `product_name` ASC";
        } else if ($select == 2) {
            $select = "ORDER BY `product_name` DESC";
        } else if ($select == 3) {
            $select = "ORDER BY `price` ASC";
        } else if ($select == 4) {
            $select = "ORDER BY `price` DESC";
        }
    }
    if (!empty($name_product)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND `product_name` LIKE '%{$name_product}%' AND";
    } else if (!empty($cat_id)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_products` {$sql} `status` = 'Đã đăng' {$select}  LIMIT $start, $num_rows");
    return $sql;
}

function total_product($cat_id, $name_product)
{
    $sql = "WHERE";
    if (!empty($name_product)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND `product_name` LIKE '%{$name_product}%' AND";
    } else if (!empty($cat_id)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_products` {$sql} `status` = 'Đã đăng'");
    return $sql;
}
function list_category()
{
    $sql = db_fetch_array("SELECT * FROM `tb_category` ");
    return $sql;
}

function list_ads($data)
{
    $sql = db_fetch_row("SELECT * FROM `tb_ads` WHERE `ads_name` = '{$data}'");
    return $sql;
}

function get_padding($num_rows)
{
    $sql = "WHERE";
    $cat_id = (!empty($_GET['cat_id'])) ? $_GET['cat_id'] : null;
    $name_product = (!empty($_GET['name_product'])) ? $_GET['name_product'] : null;
    if (!empty($name_product)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND `product_name` LIKE '%{$name_product}%' AND";
        $cat_url = "&cat_id={$cat_id}&name_product={$name_product}";
    } else if (!empty($cat_id)) {
        $sql = "WHERE `cat_id` = '{$cat_id}' AND";
        $cat_url = "&cat_id={$cat_id}";
    }
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_products` {$sql} `status` = 'Đã đăng'") / $num_rows);
    $padding = "";
    $padding .= "<ul class='pagination justify-content-center'>";
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $pagePrev = 1;
    if ($page > 1) {
        $pagePrev = $page - 1;
    }
    $padding .= "<li class='page-item '><a href='?mod=product&action=product{$cat_url}&page={$pagePrev}' class='page-link'>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = "bg-primary text-light";
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=product&action=product{$cat_url}&page={$i}'>{$i}</a></li>";
    }
    $pageNext = $num_page;
    if ($page < $num_page) {
        $pageNext = $page + 1;
    }
    $padding .= "<li class='page-item '><a href='?mod=product&action=product{$cat_url}&page={$pageNext}' class='page-link'>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}
