<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}

function update_customerAction()
{
    global $error, $fullname, $email, $username, $password, $file, $is_active, $tel, $address;
    $id = $_GET['id'];
    $data['customer'] = get_customer_by_id($id);
    if (isset($_POST['update_customer'])) {
        $error = [];
        //Kiểm tra fullname 
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra username 
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống";
        } else {
            if (is_username($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $error['username'] = "Không đúng định dạng";
            }
        }
        // //Kiểm tra password 
        // if (empty($_POST['password'])) {
        //     $error['password'] = "Không được để trống";
        // } else {
        //     if (is_password($_POST['password'])) {
        //         $password = md5($_POST['password']);
        //     } else {
        //         $error['password'] = "Không đúng định dạng";
        //     }
        // }
        //Kiểm tra email 
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống";
        } else {
            if (is_password($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra address 
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra tel 
        if (empty($_POST['tel'])) {
            $error['tel'] = "Không được để trống";
        } else {
            if (is_password($_POST['tel'])) {
                $tel = $_POST['tel'];
            } else {
                $error['tel'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra file img
        if (empty($_FILES['file']['name'])) {
            $file = $data['customer']['img'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra is_active 
        if (empty($_POST['is_active'])) {
            $is_active = 0;
        } else {
            $is_active = $_POST['is_active'];
        }
        //Kết luận
        if (empty($error)) {
            $data_customer = [
                'fullname' => $fullname,
                'username' => $username,
                // 'password' => $password,
                'email' => $email,
                'address' => $address,
                'phone_number' => $tel,
                'img' => $file,
                'is_active' => $is_active,
            ];
            update_customer($data_customer, $id);
            $error['account'] = "Cập nhật thành công";
        }
    }
    $data['customer'] = get_customer_by_id($id);
    load_view("update_customer", $data);
}
function list_customerAction()
{
    //Tác vụ
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 0;
        }
        if (!empty($_POST['checkitem'])) {
            $checkitem = $_POST['checkitem'];
            foreach ($checkitem as $item) {
                update_action($action, $item);
            }
        }
    }
    //
    $data['num_customer'] = num_customer();
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 10;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data['list_customer'] = list_customer($start, $num_rows);
    $data['is_active'] = [
        '0' => 'Chưa xác thực',
        '1' => 'Đã xác thực',
    ];
    load_view("list_customer", $data);
}

function delete_customerAction()
{
    $id = $_GET['id'];
    delete_customer($id);
    redirect("?mod=customer&action=list_customer");
}


function detail_customerAction()
{
    load_view("detail_customer");
}
