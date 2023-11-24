<?php
function get_product_by_id($id) //Lấy chi tiết sản phẩm
{
    $sql = db_fetch_row("SELECT * FROM `tb_products` INNER JOIN `tb_category` ON tb_products.cat_id = tb_category.id WHERE `product_id` = {$id}");
    return $sql;
}
function get_padding($num_rows)
{
    $num_page = ceil(db_num_rows("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng'") / $num_rows);
    $padding = "";
    $padding .= "<ul class='list-item clearfix'>";
    for ($i = 1; $i <= $num_page; $i++) {
        $padding .= "<li><a href='?mod=product&action=main&page={$i}'>{$i}</a></li>";
    }
    $padding .= "</ul>";
    return $padding;
}
function list_products_by_sales() //Lấy danh sách sản phẩm bán chạy
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng' ORDER BY `sales` DESC LIMIT 0, 10 ");
    return $sql;
}
function total_product_by_cat_id($cat_id)
{
    $sql = db_num_rows("SELECT * FROM `tb_products` WHERE `cat_id` = '{$cat_id}' AND `status` = 'Đã đăng'");
    return $sql;
}
function list_products($select, $price, $category)
{
    $where = "WHERE";
    if (!empty($select)) {
        if ($select == 1) {
            $select = "ORDER BY `product_name` ASC";
        } else if ($select == 2) {
            $select = "ORDER BY `product_name` DESC";
        } else if ($select == 3) {
            $select = "ORDER BY `price` ASC";
        } else if ($select == 4) {
            $select = "ORDER BY `price` DESC";
        }
    }
    if (!empty($price)) {
        if ($price == 1) {
            $price = "`price` BETWEEN 0 AND 1000000";
        } else if ($price == 2) {
            $price = "`price` BETWEEN 1000000 AND 5000000";
        } else if ($price == 3) {
            $price = "`price` BETWEEN 5000000 AND 15000000";
        } else if ($price == 4) {
            $price = "`price` BETWEEN 15000000 AND 25000000";
        } else if ($price == 5) {
            $price = "`price` > 25000000";
        }
    }
    if (!empty($category)) {
        if ($category == 1) {
            $category = "`cat_id` = 1";
        } else if ($category == 2) {
            $category = "`cat_id` = 2";
        } else if ($category == 3) {
            $category = "`cat_id` = 3";
        }
    }
    if (!empty($category) && !empty($price)) {
        $where = "WHERE ({$price}) AND ({$category}) AND";
    } else if (!empty($category) || !empty($price)) {
        $where = "WHERE {$price}{$category} AND";
    }
    $sql = db_fetch_array("SELECT * FROM `tb_products` {$where} `status` = 'Đã đăng' {$select}");
    return $sql;
}

function add_cart($id, $num_order)
{
    add_product_put_cart($id, $num_order);
    get_list_buy_cart();
    redirect("thanh-toan.html");
}

function list_same_category($cat_id)
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `cat_id` = '$cat_id'");
    return $sql;
}

function list_ads($data)
{
    $sql = db_fetch_row("SELECT * FROM `tb_ads` WHERE `ads_name` = '{$data}'");
    return $sql;
}

function add_comments($data_add_comemnt) //Cập nhật bình luận
{
    db_insert("tb_comments", $data_add_comemnt);
}

function get_list_comments($id)
{
    $sql = db_fetch_array("SELECT * FROM `tb_comments` INNER JOIN `tb_customers` 
    ON tb_comments.id_customer = tb_customers.id WHERE `id_product` = '$id' ORDER BY `time` DESC");
    return $sql;
}

function product_star_by_id($id) //Lấy trung binh đánh giá khách hàng
{
    $sql = db_fetch_row("SELECT AVG(`star`) as 'star' FROM `tb_comments` WHERE `id_product` = {$id} AND `star` > 1");
    return $sql;
}

function total_comments($id) //Lấy tổng tất cả bình luận và đánh giá sp
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id}"));
    return $sql;
}
function num_product_star_5($id)
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} AND `star` = 5"));
    return $sql;
}

function num_product_star_4($id)
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} AND `star` = 4"));
    return $sql;
}
function num_product_star_3($id)
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} AND `star` = 3"));
    return $sql;
}
function num_product_star_2($id)
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} AND `star` = 2"));
    return $sql;
}

function num_product_star_1($id)
{
    $sql = count(db_fetch_array("SELECT * FROM `tb_comments` WHERE `id_product` = {$id} AND `star` = 1"));
    return $sql;
}

function get_img_detail_by_id($id) //Lấy danh sách ảnh chi tiết của sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_image_details` WHERE `product_id` = {$id}");
    return $sql;
}
function get_variant_color($id) //Lấy danh sách biên thể màu sắc theo id sp
{
    $sql = db_fetch_array("SELECT * FROM `tb_color_variants` WHERE `product_id` = {$id}");
    return $sql;
}
function get_variant_ram($id) //Lấy danh sách biến thể ram theo id sản phẩm
{
    $sql = db_fetch_array("SELECT * FROM `tb_ram_variants` WHERE `product_id` = {$id}");
    return $sql;
}

function get_list_color_variant_by_ram_id($ram_id) //Lấy danh sách biến thể màu sắc theo ram id
{
    $sql = db_fetch_array("SELECT * FROM `tb_color_variants` WHERE `ram_id` = {$ram_id}");
    return $sql;
}

function get_color_variant($color_id) //Lấy ra màu sắc theo id màu sắc
{
    $sql = db_fetch_row("SELECT * FROM `tb_color_variants` INNER JOIN `tb_products` ON tb_color_variants.product_id = tb_products.product_id
     INNER JOIN `tb_ram_variants` ON tb_color_variants.ram_id = tb_ram_variants.id 
     WHERE tb_color_variants.id = {$color_id}");
    return $sql;
}
function get_product_promotion_by_id($id) //Lấy giá khuyễn mãi theo id sản phẩm
{
    $sql = db_fetch_row("SELECT * FROM `product_promotion` INNER JOIN `tb_promotions` ON product_promotion.promotion_id = tb_promotions.id 
    INNER JOIN `tb_products` ON product_promotion.product_id = tb_products.product_id WHERE tb_products.product_id = {$id}");
    if (!$sql) {
        return false;
    }
    return $sql['discount_rate'];
}
