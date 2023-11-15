<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}
function list_adsAction()
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
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['list_ads'] = list_ads($start, $num_rows);
    load_view("list_ads", $data);
}

function add_adsAction()
{
    global $error, $link, $file, $name;
    if (isset($_POST['add-ads'])) {
        $error = [];
        //Kiểm tra name
        if (empty($_POST['name'])) {
            $error['name'] = "Không được để trống";
        } else {
            $name = $_POST['name'];
        }
        //Kiểm tra link
        if (empty($_POST['link'])) {
            $error['link'] = "Không được để trống";
        } else {
            $link = $_POST['link'];
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $error['file'] = "Không được để trống";
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        //Kết luận
        if (empty($error)) {
            $data = [
                'ads_name' => $name,
                'ads_img' => $file,
                'creator' => $_SESSION['admin_login'],
                'link' => $link
            ];
            add_ads($data);
            $error['account'] = "Thêm thành công";
        }
    }
    load_view("add_ads");
}

function update_adsAction()
{
    global $error, $name, $file, $slug;
    $id = $_GET['id'];
    $data['ads'] = get_ads_by_id($id);
    if (isset($_POST['update-ads'])) {
        $error = [];
        //Kiểm tra name
        if (empty($_POST['name'])) {
            $error['name'] = "Không được để trống";
        } else {
            $name = $_POST['name'];
        }
        //Kiểm tra link
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống";
        } else {
            $slug = $_POST['slug'];
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $file = $data['ads']['ads_img'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        //Kết luận
        if (empty($error)) {
            $data_media = [
                'ads_name' => $name,
                'ads_img' => $file,
                'creator' => $_SESSION['admin_login'],
                'link' => $slug
            ];
            update_ads($data_media, $id);
            $error['account'] = "Sửa thành công";
        }
    }
    $data['ads'] = get_ads_by_id($id);
    load_view("update_ads", $data);
}

function delete_adsAction()
{
    $id = $_GET['id'];
    delete_ads($id);
    redirect("?mod=ads&action=list_ads");
}
