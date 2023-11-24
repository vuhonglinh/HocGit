<?php

function get_list_products_delete($start, $num_rows) //Lấy danh sách sản phẩm đã xóa
{
    $sql = db_fetch_array("SELECT * FROM `tb_category` INNER JOIN `tb_deleted_products` ON tb_category.id = tb_deleted_products.cat_id LIMIT $start, $num_rows");
    return $sql;
}
function num_products() //Số lượng sản phẩm
{
    return db_num_rows("SELECT * FROM `tb_products`");
}

function num_products_posted() //Số lượng sản phẩm đã đăng
{
    return db_num_rows("SELECT * FROM `tb_products` WHERE `status`= 'Đã đăng' ");
}

function num_products_pending() //Số lượng sản phẩm chờ xét duyệt
{
    return db_num_rows("SELECT * FROM `tb_products` WHERE `status`= 'Chờ xét duyệt'");
}

function num_product_delete() //Số lượng sản phẩm trong danh sách sp đã xóa
{
    return db_num_rows("SELECT * FROM `tb_deleted_products`");
}

function get_padding($num_rows)
{
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_deleted_products` ") / $num_rows);
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=product&controller=delete&action=list_product_delete&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-info text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=product&controller=delete&action=list_product_delete&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=product&controller=delete&action=list_product_delete&page={$page_next}' title=''>&raquo;</a></li>";

    $padding .= "</ul>";
    return $padding;
}

function get_list_cat() //Lấy danh sách danh mục sản phẩm 
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    return $sql;
}


function num_list_products_by_cat($cat_id)
{
    $sql = db_num_rows("SELECT * FROM `tb_products` WHERE `cat_id` = '{$cat_id}'");
    return $sql;
}

function reset_product($id) //Khôi phục sản phẩm
{
    $item = db_fetch_row("SELECT * FROM `tb_deleted_products` WHERE `product_id` = {$id}");
    $data = [
        'product_id'  => $item['product_id'],
        'product_code' => $item['product_code'],
        'product_name' => $item['product_name'],
        'price' => $item['price'],
        'product_desc' => $item['product_desc'],
        'product_thumb' => $item['product_thumb'],
        'product_content' => $item['product_content'],
        'status' => "Chờ xét duyệt",
        'cat_id' => $item['cat_id'],
        'creator' => $_SESSION['user_login'],
        'sales' => $item['sales'],
        'quantity' => $item['quantity'],
    ];
    db_insert("tb_products", $data);
    redirect("?mod=product&controller=delete&action=list_product_delete");
}

function delete_product($id) //Xóa vĩnh viễn sản phẩm
{
    db_delete("tb_deleted_products", "`product_id` = {$id}");
    redirect("?mod=product&controller=delete&action=list_product_delete");
}

function update_action($action, $id) //Cập nhật tác vụ danh sách xóa sản phẩm
{
    if ($action == 1) { //Xóa vĩnh viễn
        db_delete("tb_deleted_products", "`product_id` = {$id}");
        return true;
    } else if ($action == 2) { //Khôi phục sản phẩm
        $item = db_fetch_row("SELECT * FROM `tb_deleted_products` WHERE `product_id` = {$id}");
        $data = [
            'product_id'  => $item['product_id'],
            'product_code' => $item['product_code'],
            'product_name' => $item['product_name'],
            'price' => $item['price'],
            'product_desc' => $item['product_desc'],
            'product_thumb' => $item['product_thumb'],
            'product_content' => $item['product_content'],
            'status' => "Chờ xét duyệt",
            'cat_id' => $item['cat_id'],
            'creator' => $_SESSION['user_login'],
            'star' => $item['star'],
            'quantity' => $item['quantity'],
        ];
        db_insert("tb_products", $data);
        db_delete("tb_deleted_products", "`product_id` = '{$id}'");
        return true;
    } else {
        return false;
    }
}
