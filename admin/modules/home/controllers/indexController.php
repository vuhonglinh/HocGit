<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
    $date = date("Y-m-d");
    $data['total_order_price'] = total_order_price($date);//Tổng số tiền đặt hàng trong ngày
    $data['list_order'] = list_order();//Danh sách đơn hàng
    $data['list_customer'] = list_customer();//Danh sách khách hàng
    $data['list_product'] = list_product();
    load_view('main', $data);
}
