<?php
function add_menu_data($data_menu)
{
    db_insert("tb_menu", $data_menu);
}

function list_parent()//Danh sách những thằng menu cha
{
    $sql = db_fetch_array("SELECT * FROM `tb_menu` ORDER BY `number_order`");
    if ($sql > 0) {
        return $sql;
    }
    return false;
}

function delete_menu($id)
{
    db_delete("tb_menu", "`id`='$id'");
}

function update_menu_data($data, $id)
{
    db_update("tb_menu", $data, "`id`='$id'");
}

function get_update_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_menu` WHERE `id`='$id' ");
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
