<?php
function tb_category()
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    return $sql;
}


function update_quantity($cat_id) //Cập nhật số lượng danh mục
{
    $quantity = db_fetch_row("SELECT SUM(`quantity`) as `total` FROM `tb_products` WHERE `cat_id` = '$cat_id'");
    $data = [
        'quantity' =>  $quantity['total'],
    ];
    db_update("tb_category", $data, "`id` = '$cat_id'");
}


function  add_cat($data_cat)
{
    db_insert("tb_category", $data_cat);
}

function update_cat($data, $id)
{
    db_update('tb_category', $data, "`id`= {$id}");
}
function get_cat_by_id($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_category` WHERE `id` = {$id}");
    return $sql;
}

function delete_cat($id)
{
    db_delete('tb_category', "`id`= {$id}");
}

function update_action_cat($action, $item) //Cập nhật tác vụ danh mục SP
{
    if ($action == 1) { //Xóa
        db_delete("tb_category", "`id` = '{$item}'");
        return true;
    }
    return false;
}


function get_list_cat() //Lấy danh sách danh mục sản phẩm 
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    return $sql;
}
