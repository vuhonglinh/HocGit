<?php
function add_post_data($data)
{
    db_insert("tb_posts", $data);
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
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_posts` {$sql} ") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=post&action=list_post{$url}&page={$page_prev}' title=''>&laquo;</a></li>";

    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-info text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item'><a class='page-link {$style}' href='?mod=post&action=list_post{$url}&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=post&action=list_post{$url}&page={$page_next}' title=''>&raquo;</a></li>";

    $padding .= "</ul>";
    return $padding;
}



function list_posts($start, $num_rows, $status)
{
    if (!empty($status)) {
        $status = "WHERE `status` = '{$status}'";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_posts` {$status} LIMIT $start, $num_rows");
    return $sql;
}

function get_post_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_posts` WHERE `post_id` = '{$id}'");
    return $sql;
}

function update_post_data($data_post, $id)
{
    db_update("tb_posts", $data_post, "`post_id` = '{$id}'");
}

function delete_post($id)
{
    db_delete("tb_posts", "`post_id`= '{$id}'");
}

function num_posts()
{
    return db_num_rows("SELECT * FROM `tb_posts`");
}

function num_posts_posted()
{
    return db_num_rows("SELECT * FROM `tb_posts` WHERE `status`= 'Đã đăng' ");
}

function num_posts_pending()
{
    return db_num_rows("SELECT * FROM `tb_posts` WHERE `status`= 'Chờ xét duyệt'");
}

function update_action($action, $item)
{
    if ($action == 1) { //Xóa
        db_delete("tb_posts", "`post_id` = '{$item}'");
        return true;
    } else if ($action == 2) { //Đã đăng
        $status = "Đã đăng";
    } else if ($action == 3) { //Chờ xét duyệt
        $status = "Chờ xét duyệt";
    }
    $data = [
        'status' => $status,
    ];
    db_update("tb_posts", $data, "`post_id` = '{$item}'");
}
