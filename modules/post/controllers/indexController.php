<?php
function construct()
{
    load_module("index");
}

function indexAction()
{
}
function mainAction()
{
    $id = $_GET['id'];
    $data['list_products_by_star'] = list_products_by_sales();
    $data['list_page'] = list_page($id);
    load_view("main", $data);
}
