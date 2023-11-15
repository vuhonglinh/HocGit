<?php
function construct()
{
    load_module("index");
}
function indexAction()
{
    global $total_page;
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 7;
    $starts = ($page - 1) * $num_rows;
    $total_page = ceil(total_list_posts() / $num_rows);
    $data['list_posts'] = list_posts($starts, $num_rows);
    $data['list_products_by_sales'] = list_products_by_sales();
    load_view('main', $data);
}

function detail_blogAction()
{
    $id = $_GET['id'];
    $data['list_products_by_sales'] = list_products_by_sales();
    $data['detail_blog'] = detail_blog($id);
    load_view('detail_blog', $data);
}
