<?php

function is_username($data)
{
    $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (preg_match($pattern, $data)) {
        return true;
    }
    return false;
}
function is_password($data)
{
    $pattern = "/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/";
    if (preg_match($pattern, $data)) {
        return true;
    }
    return false;
}

function is_email($data)
{
    $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (preg_match($pattern, $data)) {
        return true;
    }
    return false;
}

function is_tel($data)
{
    $pattern = "/^[0-9]{10}$/";
    if (preg_match($pattern, $data)) {
        return true;
    }
    return false;
}

function is_file_img($data)
{
    $duoiFile = ['jpg', 'png', 'jpeg', 'gif', 'tiff'];
    $duoiImg = pathinfo($data, PATHINFO_EXTENSION);
    if (in_array($duoiImg, $duoiFile)) {
        return true;
    } else {
        return false;
    }
}
function form_error($data)
{
    global $error;
    if (!empty($error[$data])) return "<p class='error text-danger'>{$error[$data]}</p>";
}

function set_value($data)
{
    global $$data;
    if (!empty($$data)) {
        return $$data;
    }
    return false;
}

function check_array($array)
{
    foreach ($array as $value) {
        if ($value == "") {
            return true;
        }
        if (is_array($value)) {
            foreach ($value as $v) {
                if ($v == "") {
                    return true;
                }
            }
        }
    }
    return false;
}
function user_exists($email, $username) //Kiểm tra xem đã có ai sử dụng tài khoản chưa mới cho đk
{
    $sql = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '$username' OR `email` = '$email'");
    if ($sql == 0) {
        return true;
    }
    return false;
}

function user_add($data)
{
    if (is_array($data)) {
        db_insert('tbl_users', $data);
    }
}
