<?php
function construct()
{
    load_module("index");
}

function chatAjaxAction()
{
    $message = $_POST['message'];
    $id = info_login("id");
    $data = [
        'message' => $message,
        'customer_id' => $id,
        'status' => 0,
    ];
    add_chat($data);
    $result = get_list_chat_by_id($id);
    echo json_encode($result);
}
function indexAction()
{
    global $error, $fullname, $email, $address, $phone_number, $file;
    $username = $_SESSION['user_login'];
    //Lấy danh sách đơn hàng
    $data['list_order'] = list_order($username);


    $data['users'] = get_user_by_id($username);
    if (isset($_POST['update_info'])) {
        $error = [];
        //Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra phone_number
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống";
        } else {
            if (is_tel($_POST['phone_number'])) {
                $phone_number = $_POST['phone_number'];
            } else {
                $error['phone_number'] = "Số điện thoại không đúng định dạng";
            }
        }
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống";
        } else {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = "Email không đúng định dạng";
            }
        }
        //Kiểm tra img
        if (empty($_FILES['file']['name'])) {
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "admin/img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        //Kết luận
        if (empty($error)) {
            $data_update = [
                'fullname' => $fullname,
                'address' => $address,
                'phone_number' => $phone_number,
                'email' => $email,
                'img' => $file
            ];
            update_user($username, $data_update);
            $error['account'] = "Cập nhật thông tin thành công";
        }
    }

    //PHẦN ĐỔI MẬT KHẨU CHO NGƯỜI DÙNG
    if (isset($_POST['btn-change-pass'])) {
        $error = [];
        #Kiểm tra password
        if (empty($_POST['pass-old'])) {
            $error['account'] = "Bạn vui lòng nhập mật khẩu cũ!";
        } else {
            if (exits_password(md5($_POST['pass-old']))) { //Kiểm tra mật khẩu cũ
                if (empty($_POST['pass-new'])) { //Kiểm tra mật khẩu mới
                    $error['pass-new'] = "Vui lòng không để trống";
                } else {
                    if (is_password($_POST['pass-new'])) {
                        $pass_new = md5($_POST['pass-new']);
                        if (md5($_POST['confirm-pass']) == $pass_new) { //Kiểm tra lại mật khẩu
                            $confirm_pass = md5($_POST['confirm-pass']);
                        } else {
                            $error['confirm-pass'] = "Mật khẩu không chính xác";
                        }
                    } else {
                        $error['pass-new'] = "Mật khẩu không đúng định dạng";
                    }
                }
            } else {
                $error['pass-old'] = "Mật khẩu không chính xác";
            }
        }

        //Kết luận
        if (empty($error)) {
            $data = [
                'password' => $confirm_pass
            ];
            update_password_reset(user_login(), $data);
            $error['account'] = "Cập nhật mật khẩu thành công";
        }
    }
    $data['list_order'] = list_order($username);
    $data['users'] = get_user_by_id($username);
    load_view("main", $data);
}

function ajaxAction()
{
    if (!empty($_POST['number'])) {
        $number = $_POST['number'];
        $upload = "admin/img/";
        $targetFile = $upload . basename($_FILES["file"]["name"]);
        $duoiFile = ['jpg', 'png', 'jpeg', 'gif', 'tiff'];
        $duoiImg = pathinfo($targetFile, PATHINFO_EXTENSION);
        if (in_array($duoiImg, $duoiFile)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $data = [
                    'targetFile' => $targetFile,
                    'number' => $number,
                ];
                echo json_encode($data);
            } else {
                echo json_encode(array('status' => 'error', 'number' => $number,));;
            }
        } else {
            echo json_encode(array('status' => 'error', 'number' => $number,));;
        }
    }
}

function chatAction()
{
    $id = info_login("id");
    $data['list_chat'] = get_list_chat_by_id($id);
    load_view('chat', $data);
}
