<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="trang-chu.html">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="bai-viet.html">Bài viết</a>
                </li>
                <li class="breadcrumb-item active">
                    <?php echo $detail_blog['post_title'] ?>
                </li>
            </nav>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 border-danger">
                <div class="list-group mt-4">
                    <div class="list-group-item list-group-item-action bg-secondary text-light">SẢN PHẨM BÁN
                        CHẠY</div>
                    <?php if (!empty($list_products_by_sales)) :
                        foreach ($list_products_by_sales as $item) :
                    ?>
                            <div class="list-group-item list-group-item-action" id="list-group-item">
                                <div class="media">
                                    <a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>">
                                        <img src="admin/img/<?php echo $item['product_thumb'] ?>" class="img-fluid img-thumbnail border-0 mr-3" style="height: 80px;" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a class="text-decoration-none" id="mane-product" href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>"><?php echo $item['product_name'] ?></a>
                                        <div class="d-flex">
                                            <p class="text-danger float-left" style="font-size: 12px;"><?php echo currency_format($item['price']) ?></p>
                                        </div>
                                        <?php if ($item['quantity'] < 1) : ?>
                                            <a onclick="return alert('Sản phẩm hiện tại không còn hàng')" class="text-decoration-none">Mua ngay</a>
                                        <?php else : ?>
                                            <a href="?mod=product&action=add_cart&id=<?php echo $item['product_id'] ?>" class="text-decoration-none">Mua ngay</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
            <div class="col-md-9 border-danger">
                <div class="row">
                    <div class="col-md-12 bg-white">
                        <h3><?php echo $detail_blog['post_title'] ?></h3>
                        <p class="text-black-50"><img src="img/oclock.png" alt=""><?php echo $item['created_date'] ?></p>
                        <div class="mt-4">
                            <?php echo $detail_blog['post_content'] ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>