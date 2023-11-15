<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}
function list_pageAction()
{
    //Tác vụ xóa
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = null;
        }
        if (!empty($_POST['checkitem'])) {
            $checkitem = $_POST['checkitem'];
            foreach ($checkitem as $item) {
                action_delete($action, $item);
            }
        }
    }
    //
    $num_rows = 5;
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 10;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data['list_page'] = list_page($start, $num_rows);
    load_view("list_page", $data);
}

function add_pageAction()
{
    global $error, $title, $desc, $slug;
    if (isset($_POST['add-page'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không đươc để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không đươc để trống";
        } else {
            $slug = $_POST['slug'];
        }
        //Kiểm tra desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không đươc để trống";
        } else {
            $desc = $_POST['desc'];
        }
        //Kết luận
        if (empty($error)) {
            $data_page = [
                'page_title' => $title,
                'slug' => $slug,
                'page_content' => $desc,
                'creator' => $_SESSION['admin_login'],
            ];
            add_page($data_page);
            $error['account'] = "Thêm thành công";
        }
    }
    load_view("add_page");
}

function update_pageAction()
{
    $id = $_GET['id'];
    global $error, $title, $desc, $slug;
    if (isset($_POST['update-page'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không đươc để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không đươc để trống";
        } else {
            $slug = $_POST['slug'];
        }
        //Kiểm tra desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không đươc để trống";
        } else {
            $desc = $_POST['desc'];
        }
        //Kết luận
        if (empty($error)) {
            $data_page = [
                'page_title' => $title,
                'slug' => $slug,
                'page_content' => $desc,
                'creator' => $_SESSION['admin_login'],
            ];
            update_page($data_page, $id);
            $error['account'] = "Sửa thành công";
        }
    }
    $data['page'] = get_page_by_id($id);
    load_view("update_page", $data);
}


function delete_pageAction()
{
    $id = $_GET['id'];
    delete_page($id);
    redirect("?mod=page&action=list_page");
}
