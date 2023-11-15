<?php
function seach_product($seach, $select)
{
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
    if (!empty($seach)) {
        $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `product_name` LIKE '%{$seach}%' {$select} ");
        return $sql;
    }
    return false;
}

function list_ads($data)
{
    $sql = db_fetch_row("SELECT * FROM `tb_ads` WHERE `ads_name` = '{$data}'");
    return $sql;
}

function check_name_product($name)
{
    $sql = db_fetch_row("SELECT * FROM `tb_products` WHERE `product_name` = '{$name}'");
    return $sql;
}
