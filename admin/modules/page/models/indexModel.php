<?php

function list_page($start, $num_rows)
{
    $sql = db_fetch_array("SELECT * FROM `tb_pages` LIMIT $start, $num_rows");
    return $sql;
}

function add_page($data_page)
{
    db_insert("tb_pages", $data_page);
}

function get_padding($num_rows)
{
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_pages`") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=page&action=list_page&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        $padding .= "<li class='page-item'><a class='page-link' href='?mod=page&action=list_page&page={$i}' title=''>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=page&action=list_page&page={$page_next}' title=''>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}

function num_pages()
{
    return db_num_rows("SELECT * FROM `tb_pages`");
}

function get_page_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_pages` WHERE `page_id` = '{$id}'");
    return $sql;
}
function update_page($data_page, $id)
{
    db_update("tb_pages", $data_page, "`page_id` = '{$id}'");
}

function delete_page($id)
{
    db_delete("tb_pages", "`page_id`= '{$id}'");
}

function action_delete($action, $item)
{
    if ($action == 1) {
        db_delete("tb_pages", "`page_id`= '{$item}'");
    }
    return false;
}
