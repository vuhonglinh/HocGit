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
    $padding = "<ul>";
    $pagePrev = 1;
    if ($page > 1) {
        $pagePrev = $page - 1;
    }
    $padding .= "<li>" .
        "<a href='?mod=page&page={$pagePrev}' class='tp-pagination-prev prev page-numbers'>" .
        "<svg width='15' height='13' viewBox='0 0 15 13' fill='none' xmlns='http://www.w3.org/2000/svg'>" .
        "<path d='M1.00017 6.77879L14 6.77879' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' />" .
        "<path d='M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' />" .
        "</svg>" .
        "</a>" .
        "</li>";
    for ($i = 1; $i <= $num_rows; $i++) {
        if ($i == $page) {
            $style = 'class="current"';
        } else {
            $style = null;
        }
        $padding .=  "<li><a {$style} href='?mod=page&page={$i}'>{$i}</a></li>";
    }
    $pageNext = $num_rows;
    if ($page < $num_rows) {
        $pageNext = $page + 1;
    }
    $padding .= "<li>" .
        "<a href='?mod=page&page={$pageNext}' class='next page-numbers'>" .
        "<svg width='15' height='13' viewBox='0 0 15 13' fill='none' xmlns='http://www.w3.org/2000/svg'>" .
        "<path d='M13.9998 6.77883L1 6.77883' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' />" .
        "<path d='M8.75684 1.55767L14.0001 6.7784L8.75684 12' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' />" .
        "</svg>" .
        "</a>" .
        "</li>";
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
