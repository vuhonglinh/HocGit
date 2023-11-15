<?php
function add_menu_data($data_menu)
{
    db_insert("list_menu", $data_menu);
}

function list_parent()
{
    $sql = db_fetch_array("SELECT * FROM `list_menu` ORDER BY `number_order`");
    if ($sql > 0) {
        return $sql;
    }
    return false;
}

function delete_menu($id)
{
    db_delete("list_menu", "`id`='$id'");
    redirect("?mod=dashboard&action=menu");
}

function update_menu_data($data, $id)
{
    db_update("list_menu", $data, "`id`='$id'");
}

function get_update_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `list_menu` WHERE `id`='$id' ");
    return $sql;
}
function has_child($data, $id)
{
    foreach ($data as $item) {
        if ($item['parent_id'] == $id) {
            return true;
        }
    }
    return false;
}

function data_tree($array, $parent = 0, $level = 0)
{
    $result = [];
    foreach ($array as $value) {
        if ($value['parent_id'] == $parent) {
            $value['level'] = $level;
            $result[] = $value;
            if (has_child($array, $value['id'])) {
                $result_child = data_tree($array, $value['id'], $level + 1);
                $result = array_merge($result, $result_child);
            }
        }
    }
    return $result;
}

function add_widget($data_widget)
{
    db_insert("interface_block", $data_widget);
}

function list_widget($start, $num_rows)
{
    $sql = db_fetch_array("SELECT * FROM `interface_block` LIMIT $start, $num_rows");
    return $sql;
}

function get_padding($num_rows)
{
    $num_page = ceil(db_num_rows("SELECT * FROM `interface_block`") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=dashboard&action=list_widget&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = "bg-primary text-light";
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=dashboard&action=list_widget&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=dashboard&action=list_widget&page={$page_next}' title=''>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}

function  update_webiste($data_widget)
{
    db_update("tb_settings", $data_widget, "`id` = 1");
}

function get_info_website()
{
    $sql = db_fetch_row("SELECT * FROM `tb_settings` ");
    return $sql;
}

function delete_widget($id)
{
    db_delete("interface_block", "`widget_id`= '{$id}'");
}
