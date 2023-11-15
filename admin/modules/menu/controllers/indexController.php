<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}


function delete_menuAction()
{
    $id = $_GET['id'];
    delete_menu($id);
    redirect("?mod=menu&action=list_menu");
}
function add_menuAction() //Thêm menu
{
    global $error, $title, $url_static, $parent_id, $menu_order;
    if (isset($_POST['sm_add'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra url_static
        if (empty($_POST['url_static'])) {
            $error['url_static'] = "Không được để trống";
        } else {
            $url_static = $_POST['url_static'];
        }
        //Kiểm tra parent_id
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //Kiểm tra menu_order
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống";
        } else {
            if (filter_var($_POST['menu_order'], FILTER_VALIDATE_INT)) {
                $menu_order = $_POST['menu_order'];
            } else {
                $error['menu_order'] = "Không đúng định dạng";
            }
        }
        //Kết luận
        if (empty($error)) {
            $data_menu = [
                'number_order' => $menu_order,
                'name' => $title,
                'url' => $url_static,
                'parent_id' => $parent_id
            ];
            add_menu_data($data_menu);
            $error['account'] = "Thêm thành công";
        }
    }
    $data['list_parent'] = list_parent();
    load_view("add_menu", $data);
}

function list_menuAction() //Phần danh sách menu
{

    $array = list_parent();
    $data['list_parent'] = data_tree($array);
    load_view("list_menu", $data);
}
function update_menuAction()
{
    $id = $_GET['id'];
    global $error, $title, $url_static, $parent_id, $menu_order;
    if (isset($_POST['sm_update'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra url_static
        if (empty($_POST['url_static'])) {
            $error['url_static'] = "Không được để trống";
        } else {
            $url_static = $_POST['url_static'];
        }
        //Kiểm tra parent_id
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //Kiểm tra menu_order
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống";
        } else {
            if (filter_var($_POST['menu_order'], FILTER_VALIDATE_INT)) {
                $menu_order = $_POST['menu_order'];
            } else {
                $error['menu_order'] = "Không đúng định dạng";
            }
        }
        //Kết luận
        if (empty($error)) {
            $data_menu = [
                'number_order' => $menu_order,
                'name' => $title,
                'url' => $url_static,
                'parent_id' => $parent_id
            ];
            update_menu_data($data_menu, $id);
            $error['account'] = "Sửa thành công";
        }
    }
    $data['list_parent'] = list_parent();
    $data['menu'] = get_update_by_id($id);
    load_view("update_menu", $data);
}
