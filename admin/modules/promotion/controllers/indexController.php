<?php
function construct()
{
    load_module("index");
}

function add_promotionAction() //Thêm khuyễn mãi
{
    global $error, $title, $description, $startDate, $endDate, $discount_rate;
    if (isset($_POST["add_promotions"])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra description
        if (empty($_POST['description'])) {
            $error['description'] = "Không được để trống";
        } else {
            $description = $_POST['description'];
        }
        //Kiểm tra startDate
        if (empty($_POST['startDate'])) {
            $error['date'] = "Không được để trống";
        } else {
            $startDate = $_POST['startDate'];
        }
        //Kiểm tra endDate
        if (empty($_POST['endDate'])) {
            $error['date'] = "Không được để trống";
        } else {
            $endDate = $_POST['endDate'];
        }
        //Kiểm tra discount_rate
        if (empty($_POST['discount_rate'])) {
            $error['discount_rate'] = "Không được để trống";
        } else {
            if (filter_var($_POST['discount_rate'], FILTER_VALIDATE_INT)) {
                $discount_rate = $_POST['discount_rate'];
            } else {
                $error['discount_rate'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra sản phẩm
        if (empty($_POST['product_id'])) {
            $error['check'] = "Không được để trống";
        } else {
            $list_product_id = $_POST['product_id'];
        }
        //Kết luận
        if (empty($error)) {
            $data_promotions = [
                'title' => $title,
                'description' => $description,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'discount_rate' => $discount_rate,
            ];
            $id = add_promotion($data_promotions); //Add vào bảng khuyễn mãi
            foreach ($list_product_id as $key => $item) {
                $data = [
                    'product_id' => $key,
                    'promotion_id' => $id
                ];
                add_product_promotion($data); //Add vào bảng product_promotion
            }
            $error['account'] = "Thêm thành công";
        }
    }
    $data['list_products'] = get_list_products();
    load_view("add_promotion", $data);
}


function list_promotionAction() //Danh sách khuyễn mãi
{
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data["list_promotion"] = get_list_promotion($start, $num_rows, $status); //Lấy danh sách khuyễn mãi
    load_view("list_promotion", $data);
}

function update_promotionAction()
{
    $id = $_GET['id'];
    $data['promotion'] = get_promotion_by_id($id);//Lấy khuyễn mãi bằng id
    $data['list_products'] = get_list_product_promotion($id);//Lấy danh sách sản phẩm liên quan đến khuyễn mãi
    load_view("update_promotion", $data);
}
