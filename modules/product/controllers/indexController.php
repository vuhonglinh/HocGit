<?php
function construct()
{
}

function indexAction()
{
}

function ajaxAction() //Thêm bình luận
{
    load_module('index');
    $comment = $_POST['comment'];
    $id_product = $_POST['id_product'];
    $star = !empty($_POST['star']) ? $_POST['star'] : 0;
    $data = [
        'id_product' => $id_product,
        'comment_content' => $comment,
        'creator' => $_SESSION['user_login'],
        'id_customers' => info_login($key = "id"),
        'star' => $star,
    ];
    add_comments($data);
    $result = get_list_comments($id_product);
    echo json_encode($result);
}

function detail_ajaxAction()
{
    load_module('index');
    $product_id = $_POST['product_id'];
    $ram_id = $_POST['ram'];
    $color_id = $_POST['color'];
    $product = get_product_by_id($product_id); //Lấy chi tiết sản phẩm
    $color = get_color_by_id($color_id); //Lấy thuộc tính màu sắc
    $ram = get_ram_by_id($ram_id); //Lấy thuộc tính ram
    $product_name = "{$product['product_name']} {$ram['nemory_name']} {$color['color_name']} ";
    $price = $product['price'] + $ram['nemory_price'] + $color['color_price'];
    if ($ram['quantity'] < $color['quantity']) { //Lấy số lượng
        $max = $ram['quantity'];
    } else {
        $max = $color['quantity'];
    }
    $quantity = "<div onclick='minus()' class='border-primary'><img class='img-fluid img-thumbnail' src='img/minus-sign.png' alt=''></div>
    <input type='number' name='num-order' min='1' max='{$max}' value='1' id='num-order' style='width: 50px; margin: 0px 5px;' class='text-center cm-number'>
    <div onclick='plus()' class='border-primary'><img class='img-fluid img-thumbnail' src='img/add.png' alt=''></div>";
    $result = [
        'product_name' => $product_name,
        'price' => currency_format($price),
        'quantity' => $quantity
    ];
    echo json_encode($result);
}


function mainAction()
{
    load_module("index");
    global $select;
    $data['list_ads'] = list_ads("product");
    $price = (!empty($_POST['price'])) ? $_POST['price'] : null;
    $brand = (!empty($_POST['brand'])) ? $_POST['brand'] : null;
    $category = (!empty($_POST['category'])) ? $_POST['category'] : null;
    ///
    $select = (!empty($_POST['select'])) ? $_POST['select'] : null;
    $data['list_products'] = list_products($select, $price, $category);
    load_view("main", $data);
}

function productAction()
{
    load_module('product');
    $select = (!empty($_POST['select'])) ? $_POST['select'] : null;
    $data['list_ads'] = list_ads("product");
    //
    global $num_rows;
    $page =  (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 12;
    $start = ($page - 1) * $num_rows;
    //
    $data['list_category'] = list_category();
    $cat_id = (!empty($_GET['cat_id'])) ? $_GET['cat_id'] : null;
    $name_product = (!empty($_GET['name_product'])) ? $_GET['name_product'] : null;
    $data['list_product'] = list_product($cat_id, $name_product, $start, $num_rows, $select);
    $data['total_product'] = total_product($cat_id, $name_product);
    load_view("product", $data);
}

function detailAction()
{
    load_module('index');
    $id = $_GET['id'];
    //Lấy biến thể
    $data['variant_color'] = get_variant_color($id);
    $data['variant_ram'] = get_variant_ram($id);
    //Tổng số lượng đánh giá sao theo thư hạng
    $data['star_5'] = num_product_star_5($id);
    $data['star_4'] = num_product_star_4($id);
    $data['star_3'] = num_product_star_3($id);
    $data['star_2'] = num_product_star_2($id);
    $data['star_1'] = num_product_star_1($id);
    //
    $data['star'] = product_star_by_id($id); //Lấy tb đánh giá sao
    $data['count'] = total_comments($id); //Lấy tông số bình luận và đánh giá sp
    $data['product'] = get_product_by_id($id); //Lấy chi tiết sản phẩm
    $data['list_img_detail'] = get_img_detail_by_id($id); //Lấy chi tiết sản phẩm
    $data['comments'] = get_list_comments($id);
    //Share sản phẩm
    // $data['product_share'] = [
    //     'url' =>  base_url("san-pham/chi-tiet/" . create_slug($data['product']['product_name']) . "/" . $id . ".html"),
    //     'img' => 'anhdienthoaij.jpg',
    // ];
    load_view('detail', $data);
}
function add_cartAction()
{
    load_module("index");
    $id = $_GET['id'];
    $num_order =  !empty($_POST['num-order']) ? $_GET['num_order'] : 1;
    add_cart($id, $num_order);
}

function seach_productAction()
{

    load_module("seach_product");
    $data['list_ads'] = list_ads("product");
    $select = (!empty($_POST['select'])) ? $_POST['select'] : null;
    $seach = (!empty($_GET['seach'])) ? $_GET['seach'] : null;
    $data['seach_product'] = seach_product($seach, $select);
    load_view("seach_product", $data);
}

function seachAction()
{
    load_module("seach_product");
    $seach = $_POST['seach'];
    $item = check_name_product($seach);
    if ($item != null) {
        $slug = create_slug($item['product_name']);
        $id = $item['product_id'];
        redirect("san-pham/chi-tiet/{$slug}/{$id}.html");
    } else {
        redirect("?mod=product&action=seach_product&seach={$seach}");
    }
}
