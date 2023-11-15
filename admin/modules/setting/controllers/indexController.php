<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}

function mainAction()
{
    global $error, $title, $file, $address, $phone, $email, $introduce;
    $data['website'] = get_info_website();
    if (isset($_POST['update_website'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $file = $data['website']['logo'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        //Kiểm tra desc
        if (empty($_POST['introduce'])) {
            $error['introduce'] = "Không được để trống";
        } else {
            $introduce = $_POST['introduce'];
        }
        //Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra phone
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống";
        } else {
            $phone = $_POST['phone'];
        }
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống";
        } else {
            $email = $_POST['email'];
        }
        //Kết luận
        if (empty($error)) {
            $data_website = [
                'title' => $title,
                'logo' => $file,
                'introduce' => $introduce,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
            ];
            update_webiste($data_website);
            $error['account'] = "Sửa thành công";
        }
    }
    $data['website'] = get_info_website();
    load_view("main", $data);
}
