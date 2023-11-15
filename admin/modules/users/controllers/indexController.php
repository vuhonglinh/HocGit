<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}

function updateAction()
{
    global $error;
    if (isset($_POST['btn-update'])) {
        $error = [];
        #Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra tel
        if (empty($_POST['tel'])) {
            $error['tel'] = "Không được để trống";
        } else {
            if (is_tel($_POST['tel'])) {
                $tel = $_POST['tel'];
            } else {
                $error['tel'] = 'Số điện thoại không đúng định dạng';
            }
        }
        #Kiểm tra fullname
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kết luận
        if (empty($error)) {
            $data = [
                'fullname' => $fullname,
                'phone_number' => $tel,
                'address' => $address,
            ];
            $error['account'] = "Cập nhật thành công";
            update_user_login(user_login(), $data);
        }
    }
    $info_user = get_user_by_username(user_login());
    $data['info_user'] = $info_user;
    load_view('update', $data);
}

function resetAction() //Cập nhật mật khẩu
{
    global $error;
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
                        if (empty($_POST['confirm-pass'])) {
                            $error['confirm-pass'] = "Vui lòng không để trống";
                        } else {
                            if (md5($_POST['confirm-pass']) == $pass_new) { //Kiểm tra lại mật khẩu
                                $confirm_pass = md5($_POST['confirm-pass']);
                            } else {
                                $error['confirm-pass'] = "Mật khẩu không chính xác";
                            }
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
    load_view('reset');
}

function mainAction()
{
    global $error;
    if (isset($_POST['btn-update'])) {
        $error = [];
        #Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra tel
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống";
        } else {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = 'Số điện thoại không đúng định dạng';
            }
        }
        #Kiểm tra tel
        if (empty($_POST['tel'])) {
            $error['tel'] = "Không được để trống";
        } else {
            if (is_tel($_POST['tel'])) {
                $tel = $_POST['tel'];
            } else {
                $error['tel'] = 'Số điện thoại không đúng định dạng';
            }
        }
        #Kiểm tra fullname
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kết luận
        if (empty($error)) {
            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $tel,
                'address' => $address,
            ];
            $error['account'] = "Cập nhật thành công";
            update_user_login(user_login(), $data);
        }
    }
    $info_user = get_user_by_username(user_login());
    $data['info_user'] = $info_user;
    load_view('main',$data);
}
