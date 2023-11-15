<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}


function list_sliderAction()
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
    $data['num_slider'] = num_slider();
    $data['num_slider_posted'] = num_slider_posted();
    $data['num_slider_pending'] = num_slider_pending();
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $data['num_rows'] = $num_rows;
    $stars = ($page - 1) * $num_rows;
    $data['list_slider'] = list_slider($stars, $num_rows, $status);
    load_view("list_slider", $data);
}


function update_sliderAction()
{
    global $error, $slug, $slider_order, $file, $status;
    $id = $_GET['id'];
    $data['slider'] = update_slider_by_id($id);
    if (isset($_POST['update-slider'])) {
        $error = [];
        //Kiểm tra link
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống";
        } else {
            $slug = $_POST['slug'];
        }
        //Kiểm tra slider_order
        if (empty($_POST['slider_order'])) {
            $error['slider_order'] = "Không được để trống";
        } else {
            if (filter_var($_POST['slider_order'], FILTER_VALIDATE_INT)) {
                $slider_order = $_POST['slider_order'];
            } else {
                $error['slider_order'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $file = $data['slider']['slider_img'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        //Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        //Kết luận
        if (empty($error)) {
            $username =  $_SESSION['admin_login'];
            $data_slider = [
                'link' => $slug,
                'slider_img' => $file,
                'number_order' => $slider_order,
                'creator' => $username,
                'status' => $status,
            ];
            update_slider($data_slider, $id);
            $error['account'] = "Sửa thành công";
        }
    }
    $data['slider'] = update_slider_by_id($id);
    load_view("update_slider", $data);
}


function add_sliderAction()
{
    global $error, $slug, $slider_order, $file, $status;
    if (isset($_POST['add-slider'])) {
        $error = [];
        //Kiểm tra link
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống";
        } else {
            $slug = $_POST['slug'];
        }
        //Kiểm tra slider_order
        if (empty($_POST['slider_order'])) {
            $error['slider_order'] = "Không được để trống";
        } else {
            if (filter_var($_POST['slider_order'], FILTER_VALIDATE_INT)) {
                $slider_order = $_POST['slider_order'];
            } else {
                $error['slider_order'] = "Không đúng định dạng";
            }
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $error['file']  = "Không được để trống";
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/{$_FILES['file']['name']}");
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = 'Ảnh không đúng định dạng';
            }
        }
        //Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        //Kết luận
        if (empty($error)) {
            $username =  $_SESSION['admin_login'];
            $data_slider = [
                'link' => $slug,
                'slider_img' => $file,
                'number_order' => $slider_order,
                'creator' => $username,
                'status' => $status,
            ];
            add_slider($data_slider);
            $error['account'] = "Thêm thành công";
        }
    }
    load_view("add_slider");
}

function delete_sliderAction()
{
    $id = $_GET['id'];
    delete_slider($id);
    redirect("?mod=slider&action=list_slider");
}
