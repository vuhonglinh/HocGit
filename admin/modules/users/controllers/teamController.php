<?php
function construct()
{
    load_module("team");
}
function indexAction()
{
    global $num_rows;
    $page =  (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 3;
    $start = ($page - 1) * $num_rows;
    $list_users = get_list_users($start, $num_rows);
    $data['list_users'] = $list_users;
    load_view('teamindex', $data);
}

function deleteAction()
{
    $id = $_GET['id'];
    delete_user($id);
    redirect("?mod=users&controller=team&action=index");
}

function addAction()
{
    global $error, $fullname, $username, $password, $email, $tel, $address;
    if (isset($_POST['btn-add'])) {
        $error = [];
        //Kiêm tra fullname
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
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            }
        }
        //Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống";
        } else {
            if (is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            } else {
                $error['password'] = "Mật khẩu không đúng định dạng";
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
        //Kiểm tra phone_number
        if (empty($_POST['tel'])) {
            $error['tel'] = "Không được để trống";
        } else {
            if (is_tel($_POST['tel'])) {
                $tel = $_POST['tel'];
            } else {
                $error['tel'] = "Số điện thoại không đúng định dạng";
            }
        }
        //Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kết luận
        if (empty($error)) {
            if (exits_user($username, $email)) {
                $data = [
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'phone_number' => $tel,
                    'address' => $address,
                    'creator' => $_SESSION['admin_login'],
                ];
                add_users($data);
                $error['account'] = "Thêm thành công";
            } else {
                $error['account'] = "Tên đăng nhập hoặc email đã tồn tại";
            }
        }
    }
    load_view("add");
}

function updateAction()
{
    global $error, $fullname, $username, $password, $email, $address, $phone_number;
    $id = $_GET['id'];
    $data['user'] = get_user_by_id($id);
    if (isset($_POST['update_user'])) {
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra username
        // if (empty($_POST['username'])) {
        //     $error['username'] = "Không được để trống";
        // } else {
        //     if (is_username($_POST['username'])) {
        //         $username = $_POST['username'];
        //     } else {
        //         $error['username'] = "Tên đăng nhập không đúng định dạng";
        //     }
        // }
        //Kiểm tra password
        // if (empty($_POST['password'])) {
        //     $error['password'] = "Không được để trống";
        // } else {
        //     if (is_password($_POST['password'])) {
        //         $password = md5($_POST['password']);
        //     } else {
        //         $error['password'] = "Mật khẩu không đúng định dạng";
        //     }
        // }
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
        //Kiểm tra phone_number
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kết luận
        if (empty($error)) {
            $data_user = [
                'fullname' => $fullname,
                'email' => $email,
                // 'password' => $password,
                'address' => $address,
                // 'username' => $username,
                'phone_number' => $phone_number,
            ];
            update_user($data_user, $id);
            $error['account'] = "Cập nhật thành công";
        }
    }
    $data['user'] = get_user_by_id($id);
    load_view("update_team", $data);
}
