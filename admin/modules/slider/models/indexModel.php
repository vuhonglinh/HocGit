<?php
function get_padding($num_rows)
{
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    $sql = null;
    $url = null;
    if (!empty($status)) {
        $url = "&status={$status}";
        $sql = "WHERE `status` = '{$status}'";
    }
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_sliders` {$sql} ") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=slider&action=list_slider{$url}&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = "bg-primary text-light";
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=slider&action=list_slider{$url}&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=slider&action=list_slider{$url}&page={$page_next}' title=''>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}

function add_slider($data)
{
    db_insert("tb_sliders", $data);
}

function list_slider($stars, $num_rows, $status)
{
    if (!empty($status)) {
        $status = "WHERE `status` = '$status'";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_sliders` {$status} LIMIT $stars, $num_rows");
    return $sql;
}

function update_slider_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_sliders` WHERE `slider_id` = '$id'");
    return $sql;
}

function update_slider($data, $id)
{
    db_update("tb_sliders", $data, "`slider_id` = '$id'");
}

function delete_slider($id)
{
    db_delete("tb_sliders", "`slider_id` = '{$id}'");
}

function num_slider()
{
    return db_num_rows("SELECT * FROM `tb_sliders`");
}

function num_slider_posted()
{
    return db_num_rows("SELECT * FROM `tb_sliders` WHERE `status`= 'Đã đăng' ");
}

function num_slider_pending()
{
    return db_num_rows("SELECT * FROM `tb_sliders` WHERE `status`= 'Chờ xét duyệt'");
}

function update_action($action, $item) //Cập nhật tác vụ
{
    if ($action == 1) {
        db_delete("tb_sliders", "`slider_id` = '{$item}'");
        return true;
    } else if ($action == 2) {
        $status = "Đã đăng";
    } else if ($action == 3) {
        $status = "Chờ xét duyệt";
    } else {
        return false;
    }
    $data = [
        'status' => $status,
    ];
    db_update("tb_sliders", $data, "`slider_id` = '{$item}'");
}
