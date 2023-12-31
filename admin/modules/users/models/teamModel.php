<?php
function add_users($data) //Thêm mới thành viên
{
    db_insert("tb_admin", $data);
}

function get_list_users($start, $num_rows) //Lấy danh sách quản trị viên
{
    $sql = db_fetch_array("SELECT * FROM `tb_admin` WHERE NOT `username` = 'vuhonglinh123' LIMIT $start, $num_rows ");
    return $sql;
}


function delete_user($id) //Xóa quản trị viên
{
    db_query("DELETE FROM `tb_admin` WHERE `user_id` = '$id'");
}


function exits_user($username, $email)
{
    $sql = db_num_rows("SELECT * FROM `tb_admin` WHERE `username` = '$username' OR `email` = '$email'");
    if ($sql == 0) {
        return true;
    }
    return false;
}

function get_padding($num_rows)
{
    $page = (empty($_GET['page']) ? 1 : $_GET['page']);
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_admin`") / $num_rows);
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= " <li class='page-item '><a class='page-link' href='?mod=users&controller=team&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-primary text-light';
        } else {
            $style = null;
        }
        $padding .= " <li class='page-item '><a class='page-link {$style}' href='?mod=users&controller=team&page={$i}' title=''>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= " <li class='page-item '><a class='page-link' href='?mod=users&controller=team&page={$page_next}' title=''>&raquo;</a></li>";

    $padding .= "</ul>";
    return $padding;
}
function get_user_by_id($id) //Lấy dữ liệu user để cập nhật
{
    $sql = db_fetch_row("SELECT * FROM `tb_admin` WHERE `user_id` = {$id}");
    return $sql;
}

function update_user($data_user, $id) //Upload lại dữ liêu useradmin
{
    db_update("tb_admin", $data_user, "`user_id` = {$id}");
}
