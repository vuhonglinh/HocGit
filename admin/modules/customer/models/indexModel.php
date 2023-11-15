<?php
function list_customer($start, $num_rows) //Danh sách khách hàng
{
    $sql = db_fetch_array("SELECT * FROM `tb_customers` LIMIT $start, $num_rows");
    return $sql;
}

function quality_order($username) //Số đơn hàng đã mua
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_orders` WHERE `username` = '{$username}'"));
    return $sql;
}

function get_padding($num_rows)
{
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_customers`") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=sales&action=list_customer&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-info text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=sales&action=list_customer&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=sales&action=list_customer&page={$page_next}' title=''>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}

function num_customer() //Tổng số lượng khách hàng
{
    return db_num_rows("SELECT * FROM `tb_customers`");
}

function update_action($action, $item) //Cập nhật tác vụ
{
    if ($action == 1) {
        db_delete("tb_customers", "`id` = '{$item}'");
        return true;
    }
    return false;
}

function get_customer_by_id($id) //Lấy khách hàng qua id
{
    $sql = db_fetch_row("SELECT * FROM `tb_customers` WHERE `id` = {$id}");
    return $sql;
}

function update_customer($data_customer, $id) //Cập nhật khách hàng
{
    db_update("tb_customers", $data_customer, "`id` = {$id}");
}

function delete_customer($id) //Xóa khách hàng
{
    db_delete("tb_customers", "`id` = {$id}");
}
