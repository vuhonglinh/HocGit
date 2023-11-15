<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
    $data['list_ads'] =  list_ads("home");
    $data['list_products_by_sales'] = list_products_by_sales();
    $data['list_sliders'] = list_sliders();
    $data['list_ads'] = list_ads("home");
    //Danh sách điện thoại
    $data['list_products_phone'] = list_products_phone();
    //Danh sách tablet
    $data['list_products_tablet'] = list_products_tablet();
    //Danh sách laptops
    $data['list_products_laptop'] = list_products_latop();
    load_view("home", $data);
    show_array($_SESSION['cart']['buy']);
}

function ajaxAction()
{
    $id = $_POST['id'];
    add_cart_ajax($id);
    $count = count($_SESSION['cart']['buy']);
    $data = $_SESSION['cart']['buy'];
    $data = [
        'count' => $count,
        'list_add' =>  $_SESSION['cart']['buy'],
    ];
    echo json_encode($data);
}
