<?php
function list_posts($starts, $num_rows)
{
    $sql = db_fetch_array("SELECT * FROM `tb_posts` WHERE `status` = 'Đã đăng' LIMIT $starts, $num_rows");
    return $sql;
}

function total_list_posts()
{
    $sql = db_num_rows("SELECT * FROM `tb_posts` WHERE `status` = 'Đã đăng'");
    return $sql;
}

function get_padding($num_rows)
{
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $padding = "<ul class='pagination justify-content-center'>";
    $pagePrev = 1;
    if ($page > 1) {
        $pagePrev = $page - 1;
    }
    $padding .= "<li class='page-item'><a href='?mod=page&page={$pagePrev}' class='page-link'>&laquo;</a></li>";
    for ($i = 1; $i <= $num_rows; $i++) {
        if ($i == $page) {
            $style = 'bg-primary text-light';
        } else {
            $style = null;
        }
        $padding .= "<li class='page-item'><a class='page-link {$style}' href='?mod=page&page={$i}' title=''>{$i}</a></li>";
    }
    $pageNext = $num_rows;
    if ($page < $num_rows) {
        $pageNext = $page + 1;
    }
    $padding .= "<li class='page-item'><a href='?mod=page&page={$pageNext}' class='page-link'>&raquo;</a></li>";
    $padding .= "</ul>";
    return $padding;
}


function detail_blog($id)
{
    $sql = db_fetch_row("SELECT * FROM `tb_posts` WHERE `post_id` = '$id'");
    return $sql;
}

function list_products_by_sales()
{
    $sql = db_fetch_array("SELECT * FROM `tb_products` WHERE `status` = 'Đã đăng' ORDER BY `sales` DESC LIMIT 0, 10 ");
    return $sql;
}
