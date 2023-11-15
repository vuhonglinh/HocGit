<?php
get_header();
global $total_page;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="trang-chu.html">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active">
                    Bài viết
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
                <div class="row d-flex">
                    <div class="col-md-6">
                        <div class="float-left">
                            <h3 class="font-weight-normal">BLOG</h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="row h-100">
                            <?php if (!empty($list_posts)) :
                                foreach ($list_posts as $item) :
                            ?>
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <a href="bai-viet/<?php echo create_slug($item['slug']) . "-" . $item['post_id'] . ".html"; ?>" class="col-md-4">
                                                <img id="img-blog-news" src="admin/img/<?php echo $item['post_img'] ?>" class="card-img img-fluid img-thumbnail" alt="">
                                            </a>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <a href="bai-viet/<?php echo create_slug($item['slug']) . "-" . $item['post_id'] . ".html"; ?>" class="h5 card-title text-decoration-none"><?php echo $item['post_title'] ?></a>
                                                    <p class="text-black-50"><img src="img/oclock.png" alt=""><?php echo $item['created_date'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;
                            endif; ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        global $total_page;
                        echo get_padding($total_page);
                        ?>
                        <!-- End padding  -->
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>