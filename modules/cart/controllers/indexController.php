<?php
function construct()
{
    load_module("index");
}

function indexAction()
{
    load_view("show_cart");
}

function add_cartAction()
{
    $id = $_GET['id'];
    $num_order = !empty($_POST['num-order']) ? $_POST['num-order'] : null;
    add_cart($id, $num_order);
}
function deleteAction()
{
    $id = $_GET['id'];
    $data_delete =  $_GET['qty_delete'];
    cancel_purchase($id, $data_delete);
    delete_cart($id);
}
function deleteAllAction()
{
    foreach ($_SESSION['cart']['buy'] as $item) {
        cancel_purchase($item['product_id'], $item['qty']);
    };
    delete_cart_all();
    redirect("gio-hang.html");
}
function checkoutAction()
{
    if (!isset($_SESSION['is_login'])) {
        redirect("dang-nhap.html");
    }
    global $error, $fullname, $email, $address, $phone, $note;
    if (isset($_POST['order_buy'])) {
        $error = [];
        //Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống thông tin";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống thông tin";
        } else {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = "Email không đúng định dạng";
            }
        }
        //Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống thông tin";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra phone
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống thông tin";
        } else {
            if (is_tel($_POST['phone'])) {
                $phone = $_POST['phone'];
            } else {
                $error['phone'] = "Số điện thoại không đúng định dạng";
            }
        }
        //Kiểm tra note
        if (empty($_POST['note'])) {
            $error['note'] = "Không được để trống thông tin";
        } else {
            $note = $_POST['note'];
        }
        //Kết luận
        if (empty($error)) {
            //Thêm vào db số lượng sản phẩm đá bán
            $cart = $_SESSION['cart']['buy'];
            $reuslt = [];
            foreach ($cart as $item) {
                $reuslt[$item['product_id']]['product_id'] = $item['product_id'];
                $reuslt[$item['product_id']]['sales'] = $item['qty'];
            }
            update_sales_product($reuslt);
            ///
            //Phần đặt hàng
            $order_code = "VHL#" . substr(md5(date("h:i:s")), 23);
            $quantity = $_SESSION['cart']['info']['count'];
            $total_price = $_SESSION['cart']['info']['total'];
            $data_order = [
                'username' => $_SESSION['user_login'],
                'order_code' => $order_code,
                'fullname' => $fullname,
                'quantity' => $quantity,
                'total_price' => $total_price,
                'address' => $address,
                'phone' => $phone,
                'order_buy' => json_encode($_SESSION['cart']['buy'])
            ];
            //Thêm vào dánh sách khách hàng đã mua
            add_order_buy($data_order);
            $mid_content = "";
            foreach ($_SESSION['cart']['buy'] as $item) {
                $mid_content .= "<tr>
                 <td>" . $item['product_name'] . "</td>
                <td>" . "X " . $item['qty'] . "</td>
                <td>" . currency_format($item['price']) . "</td>
                </tr>";
            }
            $content = "<h1 style='color: red;'>Xin chào {$fullname}</h1>
            <p><strong>Bạn đã đặt hàng thành công!</strong></p>
            <p><strong>Mã đơn hàng:</strong> {$order_code}</p>
            <p><strong>Địa chỉ:</strong> {$address}</p>
            <p><strong>Số điện thoại:</strong> {$phone}</p>
            <p><strong>Ghi chú:</strong> {$note}</p>
            <table style='border: 1px solid greenyellow;'>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                    </tr>
                </thead>
                <tbody>              
                        {$mid_content}
                    <tr>
                        <td colspan='3'><strong>Tổng tiền: </strong>" . currency_format($_SESSION['cart']['info']['total']) . "</td>
                    </tr>
                </tbody>
            </table>
            <p><strong>Đơn hàng sẽ được giao trong vòng 3-5 ngày tới. Bạn vui lòng dữ liên lạc!</strong></p>
            <p><strong>autosmart cảm ơn bạn đã mua hàng!</strong></p>";
            send_email($email, $fullname, "Thông báo đã đặt hàng thành công", $content);
            redirect("xac-nhan-don-hang-thanh-cong.html");
        }
    }
    load_view('checkout');
}
function successAction()
{
    // delete_cart_all();
    $data['list_products'] = $_SESSION['cart']['buy'];
    $data['total'] = $_SESSION['cart']['info']['total'];
    load_view("success", $data);
    delete_cart_all();
}
function num_orderAction()
{
    if (isset($_POST['num_order'])) {
        foreach ($_POST['qty'] as $id => $qty_new) {
            update_again_quantity($id, $qty_new);
            $_SESSION['cart']['buy'][$id]['qty'] = $qty_new;
            $_SESSION['cart']['buy'][$id]['sub_total'] = $qty_new * $_SESSION['cart']['buy'][$id]['price'];
        }
        update_cart();
    }
    redirect("?mod=cart");
}
function update_ajaxAction()
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $item = $_SESSION['cart']['buy'][$id];

    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //Cập nhật số lượng
        $_SESSION['cart']['buy'][$id]['qty'] = $qty;

        //Cập nhật tổng tiền
        $sub_total = $qty * $item['price'];
        $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

        //Cập nhật toàn bộ giỏ hàng
        update_cart();

        //Gía trị trả về
        $data = [
            'sub_total' => currency_format($sub_total),
            'total' => currency_format($_SESSION['cart']['info']['total'])
        ];
        echo json_encode($data);
    }
}
