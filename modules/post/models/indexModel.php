<?php
function list_products_by_sales()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` ORDER BY `sales` DESC LIMIT 0, 10 ");
    return $sql;
}

function list_page($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_pages` WHERE `page_id` = '{$id}'");
    return $sql;
}
