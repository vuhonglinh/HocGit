<?php
function add_status_by_id($data_status, $id)
{
    db_update("tb_orders", $data_status, "`id` = '{$id}'");
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
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_orders` {$sql} ") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=sales&action=list_order{$url}&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-primary text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=sales&action=list_order{$url}&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=sales&action=list_order{$url}&page={$page_next}' title=''>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}

function list_order($start, $num_rows, $status) //Danh sách những khách hàng đã mua
{
    if (!empty($status)) {
        $status = "WHERE `status` = '{$status}'";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_orders` {$status} LIMIT $start, $num_rows");
    return $sql;
}

function detail_order($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_orders` WHERE `id` = '$id'");
    return $sql;
}

function num_orders()
{
    return db_num_rows("SELECT * FROM `tb_orders`");
}
function num_posts_pending()
{
    return db_num_rows("SELECT * FROM `tb_orders` WHERE `status`= 'Chờ xét duyệt'");
}

function num_orders_delivery()
{
    return db_num_rows("SELECT * FROM `tb_orders` WHERE `status`= 'Đang vận chuyển'");
}

function num_orders_success()
{
    return db_num_rows("SELECT * FROM `tb_orders` WHERE `status`= 'Thành công'");
}

function delete_order($id)
{
    db_delete("tb_orders", "`id` = '{$id}'");
}

function total_order()//Danh sách đơn đặt hàng
{
    $sql = db_fetch_row("SELECT SUM(`sales`)as 'total' FROM `tb_products`");
    return $sql;
}

function update_action($action, $item) //Cập nhật tác vụ
{
    if ($action == 1) {
        db_delete("tb_orders", "`id` = '{$item}'");
        return true;
    } else if ($action == 2) {
        $status = "Thành công";
    } else if ($action == 3) {
        $status = "Chờ xét duyệt";
    } else if ($action == 4) {
        $status = "Đang vận chuyển";
    } else {
        return false;
    }
    $data = [
        'status' => $status,
    ];
    db_update("tb_orders", $data, "`id` = '{$item}'");
}
