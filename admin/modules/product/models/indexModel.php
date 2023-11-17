<?php

function add_detail_img($data) //Thêm ảnh chi tiết
{
    db_insert("tb_image_details", $data);
}
function add_product_data($data) //Thêm sản phẩm
{
    return db_insert("tb_products", $data);
}

function add_variants_color($data) //Thêm thuộc tính màu sắc
{
    db_insert("tb_color_variants", $data);
}


function add_variants_ram($data) //Thêm thuộc tính ram
{
    db_insert("tb_memory_variants", $data);
}

function list_category() //Danh mục sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    return $sql;
}
function get_list_products($start, $num_rows, $status, $cat_id) //Danh sách sản phẩm
{
    if (!empty($status)) {
        $status = "WHERE `status` = '$status'";
    } else if (!empty($cat_id)) {
        $cat_id = "WHERE `cat_id` = '$cat_id'";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_category` INNER JOIN `tb_products` ON tb_category.id = tb_products.cat_id {$status}{$cat_id} LIMIT $start, $num_rows");
    return $sql;
}

function get_padding($num_rows)
{
    $status =  (!empty($_GET['status'])) ? $_GET['status'] : null;
    $cat_id =  (!empty($_GET['cat_id'])) ? $_GET['cat_id'] : null;
    $sql = null;
    $url = null;
    if (!empty($status)) {
        $url = "&status={$status}";
        $sql = "WHERE `status` = '{$status}'";
    } else if (!empty($cat_id)) {
        $url = "&cat_id={$cat_id}";
        $sql = "WHERE `cat_id` = '{$cat_id}'";
    }
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_products` {$sql} ") / $num_rows);
    if ($status == "delete") {
        $num_page = ceil(db_num_rows("SELECT * FROM `tb_deleted_products` ") / $num_rows);
    }
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "";
    $padding .= "<ul class='pagination pagination-sm m-0 float-right'>";
    $page_prev = 1;
    if ($page > 1) {
        $page_prev = $page - 1;
    }
    $padding .= "<li class='page-item'><a class='page-link' href='?mod=product&action=list_product{$url}&page={$page_prev}' title=''>&laquo;</a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            $style = 'bg-info text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item '><a class='page-link {$style}' href='?mod=product&action=list_product{$url}&page={$i}'>{$i}</a></li>";
    }
    $page_next = $num_page;
    if ($page < $num_page) {
        $page_next = $page + 1;
    }
    $padding .= "<li class='page-item '><a class='page-link' href='?mod=product&action=list_product{$url}&page={$page_next}' title=''>&raquo;</a></li>";

    $padding .= "</ul>";
    return $padding;
}


function delete_product($id) //Xóa sản phẩm theo id
{
    db_delete("tb_products", "`product_id` = '$id'");
}

function delete_related($id) //Xóa các thuộc tính liên quan đến sản phẩm theo id
{
    db_delete("tb_color_variants", "`product_id` = '$id'"); //Xóa biến thể màu sắc
    db_delete("tb_memory_variants", "`product_id` = '$id'"); //Xóa biến thể dung lượng
    db_delete("tb_image_details", "`product_id` = '$id'"); //Xóa ảnh chi tiết
}

function get_product_by_id($id) //Lấy sản phẩm theo id
{
    $sql = db_fetch_row("SELECT * FROM `tb_products`  WHERE `product_id` = '$id'");
    return $sql;
}

function update_product($id, $data) //Update sản phẩm
{
    db_update("tb_products", $data, "`product_id` = '$id'");
}

function update_quantity($cat_id) //Cập nhật số lượng danh mục
{
    $quantity = db_fetch_row("SELECT SUM(`quantity`) as `total` FROM `tb_products` WHERE `cat_id` = '$cat_id'");
    $data = [
        'quantity' =>  $quantity['total'],
    ];
    db_update("tb_category", $data, "`id` = '$cat_id'");
}

function list_cat() //Lấy danh sách danh mục
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    foreach ($sql as $item) {
        update_quantity($item['id']);
    }
    return $sql;
}

function price_max($cat_id) //Lấy giá cao nhất
{
    $sql = db_fetch_row("SELECT `price` FROM `tb_products` WHERE `cat_id` = {$cat_id} ORDER BY `price` DESC LIMIT 1");
    if (!empty($sql)) {
        return $sql['price'];
    }
}

function price_min($cat_id) //Lấy giá thấp nhất
{
    $sql = db_fetch_row("SELECT `price` FROM `tb_products` WHERE `cat_id` = {$cat_id} ORDER BY `price` ASC LIMIT 1");
    if (!empty($sql)) {
        return $sql['price'];
    }
}

function price_avg($cat_id) //Lấy giá TB nhất
{
    $sql = db_fetch_row("SELECT AVG(`price`) as `price` FROM `tb_products` WHERE `cat_id` = {$cat_id}");
    return $sql['price'];
}
function num_products() //Tổng số sản phẩm
{
    return db_num_rows("SELECT * FROM `tb_products`");
}

function num_products_posted() //Tổng số sản phẩm đã đăng
{
    return db_num_rows("SELECT * FROM `tb_products` WHERE `status`= 'Đã đăng' ");
}

function num_products_pending() //Tổng số sản phẩm chờ xét duyệt
{
    return db_num_rows("SELECT * FROM `tb_products` WHERE `status`= 'Chờ xét duyệt'");
}

function get_list_cat() //Lấy danh sách danh mục sản phẩm 
{
    $sql = db_fetch_array("SELECT * FROM `tb_category`");
    return $sql;
}
function list_comments($id, $status) //Danh sách bình luận của từng sản phẩm theo id
{
    if ($status == "new") {
        $status = "ORDER BY `time` DESC";
    } else if ($status == "old") {
        $status = "ORDER BY `time` ASC";
    } else {
        $status = "";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} {$status}");
    return $sql;
}

function delete_comment_id($delete) //Xóa binh luận
{
    db_delete("tb_comments", "`id_comment` = {$delete}");
}

function update_action($action, $id) //Cập nhật tác vụ sản phẩm
{
    if ($action == 1) { //Xóa
        $item = db_fetch_row("SELECT * FROM `tb_products` WHERE `product_id` = {$id}");
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
            'admin_delete' => $_SESSION['admin_login'],
            'star' => $item['star'],
            'quantity' => $item['quantity'],
        ];
        db_insert("tb_deleted_products", $data);
        db_delete("tb_products", "`product_id` = '{$id}'");
        return true;
    } else if ($action == 2) { //Đã đăng
        $status = "Đã đăng";
    } else if ($action == 3) { //Chờ xét duyệt
        $status = "Chờ xét duyệt";
    } else {
        return false;
    }
    $data = [
        'status' => $status,
    ];
    db_update("tb_products", $data, "`product_id` = '{$id}'");
}

function update_action_comment($action, $item) //Cập nhật tác vụ Bình luận
{
    if ($action == 1) { //Xóa
        db_delete("tb_comments", "`id_comment` = '{$item}'");
        return true;
    }
    return false;
}

function get_detail_img_by_id($id) //Lấy danh sách ảnh chi tiết của sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_image_details` WHERE `product_id`= {$id} ");
    return $sql;
}
function num_tb_products_by_cat($cat_id)
{
    $sql = db_num_rows("SELECT * FROM `tb_products` WHERE `cat_id` = '{$cat_id}'");
    return $sql;
}

function seach_product($seach) //Tìm kiếm sản phẩm
{
    if (!empty($seach)) {
        $sql = db_fetch_array("SELECT * FROM `tb_category` INNER JOIN `tb_products` ON tb_category.id = tb_products.cat_id WHERE tb_products.product_name LIKE '%{$seach}%'");
        return $sql;
    }
    return false;
}

function num_list_products_by_cat($cat_id)
{
    $sql = db_num_rows("SELECT * FROM `tb_products` WHERE `cat_id` = '{$cat_id}'");
    return $sql;
}

function get_color_variants($id) //Lấy thuộc tính màu sắc của sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_color_variants` WHERE `product_id` = {$id}");
    return $sql;
}

function get_ram_variants($id) //Lấy thuộc tính ram của sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_memory_variants` WHERE `product_id` = {$id}");
    return $sql;
}

function update_variants_ram($data_available_ram, $id) //Update thuộc tính ram của sản phẩm
{
    db_update("tb_memory_variants", $data_available_ram, "`id` = {$id}");
}


function update_variants_color($data_available_color, $id) //Update thuộc tính ram của sản phẩm
{
    db_update("tb_color_variants", $data_available_color, "`id` = {$id}");
}


function  remove_interval_variation($table, $key_string, $id) //Xóa các biến thể màu sắc không có trong danh sách id
{
    db_query("DELETE FROM `$table` WHERE id NOT IN ($key_string) AND `product_id` = {$id}");
}

function update_detail_img_by_id($key, $data_detail_img) //Cập nhật ảnh chi tiết cảu sản phẩm theo id anh chi tiết
{
    db_update("tb_image_details", $data_detail_img, "`id` = {$key}");
}

function remove_interval_detail_img($string_id, $id) //Xóa các id ảnh chi tiết nếu không tồn tại trong danh sách
{
    db_query("DELETE FROM `tb_image_details` WHERE `id` NOT IN ($string_id) AND `product_id` = {$id}");
}
