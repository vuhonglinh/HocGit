<?php
function construct()
{
    load_module('delete');
}

function indexAction()
{
}

function list_product_deleteAction()
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
    //Lấy danh sách danh mục sản phẩm
    $data['list_cat'] = get_list_cat();
    //lấy sô lượng bản ghi
    $data['num_products'] = num_products();
    $data['num_products_posted'] = num_products_posted();
    $data['num_products_pending'] = num_products_pending();
    $data['num_product_delete'] = num_product_delete();
    //
    $page =  (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data['list_products'] =  get_list_products_delete($start, $num_rows);
    load_view("list_product_delete", $data);
}

function reset_productAction()
{
    $id = $_GET['id'];
    reset_product($id);
    delete_product($id);
}

function delete_productAction()
{
    $id = $_GET['id'];
    delete_product($id);
}
