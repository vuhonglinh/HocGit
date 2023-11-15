<?php
function construct()
{
    load_module('index');
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
                $_SESSION['is_admin_login'] = true;
                $_SESSION['admin_login'] = $username;
                //Kiểm tr remnember_me
                //Kiểm tra cookie
                if (isset($_POST['remenber_me'])) {
                    setcookie('me', $username, time() + 3600);
                }
                if (!isset($_POST['remenber_me'])) {
                    setcookie('me', $username, time() - 3600);
                }
                // Chuyển hướng
                redirect("?mod=home&action=index");
            } else {
                $error['account'] = "Không đúng tài khoản hoặc mật khẩu";
            }
        }
    }
    load_view('login');
}



function logoutAction()
{
    unset($_SESSION['is_admin_login']);
    unset($_SESSION['admin_login']);
    redirect("?mod=log&action=login");
}
