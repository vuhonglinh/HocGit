<?php
function construct()
{
    load_module("index");
}
function indexAction()
{
}

function loginAction()
{
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = [];
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (is_username($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $error['username'] = 'Tên đăng nhập không đúng định dạng';
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            } else {
                $error['password'] = 'Mật khẩu không đúng định dạng';
            }
        }
        //Kết luận
        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                db_update("tb_customers", array('status' => 1), "`username` = '$username'");
                //Kiểm tr remnember_me
                //Kiểm tra cookie
                if (isset($_POST['remenber_me'])) {
                    setcookie('me', $username, time() + 3600);
                }
                if (!isset($_POST['remenber_me'])) {
                    setcookie('me', $username, time() - 3600);
                }
                // Chuyển hướng
                redirect("trang-chu.html");
            } else {
                $error['account'] = "Không đúng tài khoản hoặc mật khẩu";
            }
        }
    }
    $data['error'] = $error;
    load_view('login', $data);
}

function logoutAction()
{
    $username = $_SESSION['user_login'];
    db_update("tb_customers", array('status' => 0), "`username` = '$username'");
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("dang-nhap.html");
}

function registerAction()
{

    global $error, $email, $username, $password,  $fullname, $address, $phone_number;
    if (isset($_POST['btn-register'])) {
        $error = [];
        #Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ và tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (is_email($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $error['email'] = 'Email không đúng định dạng';
            }
        }
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (is_username($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $error['username'] = 'Tên đăng nhập không đúng định dạng';
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (is_password($_POST['password'])) {
                $password = md5($_POST['password']);
            } else {
                $error['password'] = 'Mật khẩu không đúng định dạng';
            }
        }
        #Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống mật khẩu";
        } else {
            $address = $_POST['address'];
        }
        #Kiểm tra phone_number
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống mật khẩu";
        } else {
            if (is_tel($_POST['phone_number'])) {
                $phone_number = $_POST['phone_number'];
            } else {
                $error['phone_number'] = 'Mật khẩu không đúng định dạng';
            }
        }
        //Kết luận
        if (empty($error)) {
            if (user_exists($email, $username)) {
                $active_token = md5($username . time());
                $data_customer = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'active_token' => $active_token,
                    'address' => $address,
                    'phone_number' => $phone_number
                ];
                add_customer($data_customer);
                $link_active = base_url("?mod=log&action=active&active_token={$active_token}");
                $content = "<p>Xin chào {$fullname}</p>
                <p>Bạn vui lòng ấn vào link để kích hoạt tài khoản: {$link_active}</p>
                <p>Nếu không phải bạn vui lòng bỏ qua email này</p>
                <p>autosmart</p>
                ";
                send_email($email, $fullname, "Kích hoạt tài kho", $content);
                $error['account'] = "Vui lòng kiểm tra email để kích hoạt tài khoản";
            } else {
                $error['account'] = "Email hoặc tên đăng nhập đã tồn tại trong hệ thống";
            }
        }
    }
    $data['error'] = $error;
    load_view('register', $data);
}

function activeAction()
{
    $active_token = $_GET['active_token'];
    $link_login = base_url("?mod=log&action=login");
    if (check_active_user($active_token)) {
        if (check_active_user_vadid($active_token)) {
            active_users($active_token);
            echo "Kích hoạt thành công. Bạn vui lòng đăng nhập: <a href='{$link_login}' >Đăng nhập</a>";
        } else {
            echo "Tài khoản đã được kích hoạt trước đó: <a href='{$link_login}' >Đăng nhập</a>";
        }
    } else {
        echo "Kích hoạt không hợp lệ: <a href='{$link_login}' >Đăng nhập</a>";
    }
}

function resetAction()
{
    global $error;
    $reset_token_url = (isset($_GET['reset_token'])) ? $_GET['reset_token'] : null;
    if (!empty($reset_token_url)) {
        if (check_reset_token($reset_token_url)) {
            if (isset($_POST['btn-new-pass'])) {
                $error = [];
                #Kiểm tra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống mật khẩu";
                } else {
                    if (is_password($_POST['password'])) {
                        $password = md5($_POST['password']);
                    } else {
                        $error['password'] = 'Mật khẩu không đúng định dạng';
                    }
                }
                //Kết luận
                if (empty($error)) {
                    $data = [
                        'password' => $password,
                    ];
                    update_password($data, $reset_token_url);
                    $error['account'] = "Đổi mật khẩu thành công";
                    redirect("?mod=log&action=resetOk");
                }
            }
            load_view('newPass');
        } else {
            echo "Email không tồn tại";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = [];
            #Kiểm tra email
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $error['email'] = 'Email không đúng định dạng';
                }
            }
            //Kết luận
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = [
                        'reset_token' => $reset_token,
                    ];
                    update_reset_token($data, $email); // Cập nhật mã reset users cần khôi phục mật khẩu
                    $link = base_url("?mod=log&action=reset&reset_token={$reset_token}");
                    $content = "<p>Bạn vui click vào đây để khôi phục mật khẩu: {$link}</p>
                <p>Nếu không phải bạn vui lòng bỏ qua email này</p>
                // <p>AUTOSMART.vn</p>";
                    send_email($email, "AUTOSMART", "Khôi phục mật khẩu", $content);
                    $error['account'] = "Vui lòng kiểm tra email để đổi mật khẩu";
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            }
        }
        $data['error'] = $error;
        load_view('reset', $data);
    }
}

function resetOkAction()
{
    echo "Bạn đã đổi mật khẩu thành công: <a href='?mod=log&action=login'>Đăng nhập</a>";
}
