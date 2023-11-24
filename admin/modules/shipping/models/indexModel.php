<?php
function add_menu_data($data_menu)
{
    db_insert("tb_shipping", $data_menu);
}

// function list_parent()//Danh sách những thằng menu cha
// {
//     $sql = db_fetch_array("SELECT * FROM `tb_menu` ORDER BY `number_order`");
//     if ($sql > 0) {
//         return $sql;
//     }
//     return false;
// }

function delete_menu($id)
{
    db_delete("tb_shipping", "`id`='$id'");
}

function update_menu_data($data, $id)
{
    db_update("tb_shipping", $data, "`id`='$id'");
}

function get_update_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_shipping` WHERE `id`='$id' ");
    return $sql;
}
