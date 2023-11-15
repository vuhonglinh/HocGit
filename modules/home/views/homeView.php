<?php
get_header();
global $num_rows;
?>
<div id="content" class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="home-slide" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#home-slide" class="active" data-slide-to="0"></li>
                        <li data-target="#home-slide" data-slide-to="1"></li>
                        <li data-target="#home-slide" data-slide-to="2"></li>
                        <li data-target="#home-slide" data-slide-to="3"></li>
                    </ul>
                    <div class="carousel-inner carousel-fade">
                        <?php if (!empty($list_sliders)) :
                            foreach ($list_sliders as $item) : ?>
                                <div class="carousel-item <?php echo $item['active'] ?>">
                                    <a href="<?php echo $item['link'] ?>">
                                        <img id="carousel-img-slide" class="img-fluid img-thumbnail" src="admin/img/<?php echo $item['slider_img'] ?>" alt="">
                                    </a>
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                    <a href="#home-slide" class="carousel-control-prev" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a href="#home-slide" class="carousel-control-next" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide  -->
    </div>
    <div class="container">
        <div class="row my-2">
            <div class="col-md-12 d-flex bg-transparent">
                <a href="san-pham/dien-thoai/iphone-1.html" class="text-center text-decoration-none">
                    <img src="img/logo-iphone.png" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="" class="text-center text-decoration-none">
                    <img src="img/logo-nokia.jpg" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="" class="text-center text-decoration-none">
                    <img src="img/logo-oppo.jpg" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="" class="text-center text-decoration-none">
                    <img src="img/logo-realme.png" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="san-pham/dien-thoai/samsung-1.html" class="text-center text-decoration-none">
                    <img src="img/logo-samsung.png" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="san-pham/dien-thoai/vivo-1.html" class="text-center text-decoration-none">
                    <img src="img/logo-vivo.png" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
                <a href="" class="text-center text-decoration-none">
                    <img src="img/logo-xiaomi.png" class="img-fluid img-thumbnail border rounded-pill border bg-light" alt="">
                </a>
            </div>
        </div>
        <!-- End phần show hãng  -->
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 border-danger">
                <div class="list-group">
                    <a href="" class="list-group-item list-group-item-action bg-secondary text-light">DANH MỤC
                        SẢN PHẨM</a>
                    <?php get_sidebar() ?>
                </div>
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
                <div class="mt-5">
                    <a href="<?php echo $list_ads['link'] ?>">
                        <img src="admin/img/<?php echo $list_ads['ads_img'] ?>" alt="">
                    </a>
                </div>
                <!-- End quảng cáo -->
            </div>
            <div class="col-md-9 border-danger">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div>
                            <h3 class="font-weight-normal">ĐIỆN THOẠI</h3>
                        </div>
                        <div class="row">
                            <?php foreach ($list_products_phone as $item) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="list-product text-center border border-dark rounded">
                                        <div class="add-list">
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <button class="rounded-circle" onclick="return alert('Sản phẩm hiện tại không còn hàng')">ADD</button>
                                            <?php else : ?>
                                                <button onclick="addCart(event)" class="rounded-circle" id="add-cart" id_product="<?php echo $item['product_id'] ?>">ADD</button>
                                            <?php endif; ?>
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <a onclick="return alert('Sản phẩm hiện tại không còn hàng')">MUA</a>
                                            <?php else : ?>
                                                <a href="?mod=product&action=add_cart&id=<?php echo $item['product_id'] ?>">MUA</a>
                                            <?php endif; ?>
                                        </div>
                                        <div id="img-product-size">
                                            <img class="img-fluid img-thumbnail border-0" src="admin/img/<?php echo $item['product_thumb'] ?>" alt="">
                                        </div>
                                        <div class="type-product bg-primary">
                                            <p class="text-white m-auto"><img class="img-fluid img-thumbnail border-0 bg-transparent" src="img/giftbox.png" alt="">Giảm thêm đến 300k </p>
                                        </div>
                                        <div class="border-top">
                                            <a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>" class="text-dark text-decoration-none"><strong><?php echo $item['product_name'] ?></strong></a>
                                            <div id="text-price" class="d-flex">
                                                <p class="text-danger ml-2 font-weight-bold"><?php echo currency_format($item['price']) ?></p>
                                                <p class="text-black-50 mr-2"><del><?php echo currency_format($item['price'] + ($item['price'] * 0.2)) ?></del>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
                <!-- End phần điện thoại  -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div>
                            <h3 class="font-weight-normal">LAPTOP</h3>
                        </div>

                        <div class="row">
                            <?php foreach ($list_products_laptop as $item) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="list-product text-center border border-dark rounded">
                                        <div class="add-list">
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <button class="rounded-circle" onclick="return alert('Sản phẩm hiện tại không còn hàng')">ADD</button>
                                            <?php else : ?>
                                                <button onclick="addCart(event)" class="rounded-circle" id="add-cart" id_product="<?php echo $item['product_id'] ?>">ADD</button>
                                            <?php endif; ?>
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <a onclick="return alert('Sản phẩm hiện tại không còn hàng')">MUA</a>
                                            <?php else : ?>
                                                <a href="?mod=product&action=add_cart&id=<?php echo $item['product_id'] ?>">MUA</a>
                                            <?php endif; ?>
                                        </div>
                                        <div id="img-product-size">
                                            <img class="img-fluid img-thumbnail border-0" src="admin/img/<?php echo $item['product_thumb'] ?>" alt="">
                                        </div>
                                        <div class="type-product bg-primary">
                                            <p class="text-white m-auto"><img class="img-fluid img-thumbnail border-0 bg-transparent" src="img/giftbox.png" alt="">Giảm thêm đến 300k </p>
                                        </div>
                                        <div class="border-top">
                                            <a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>" class="text-dark text-decoration-none"><strong><?php echo $item['product_name'] ?></strong></a>
                                            <div id="text-price" class="d-flex">
                                                <p class="text-danger ml-2 font-weight-bold"><?php echo currency_format($item['price']) ?></p>
                                                <p class="text-black-50 mr-2"><del><?php echo currency_format($item['price'] + ($item['price'] * 0.2)) ?></del>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
                <!-- End phần laptop  -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div>
                            <h3 class="font-weight-normal">MÁY TÍNH BẢNG</h3>
                        </div>

                        <div class="row">
                            <?php foreach ($list_products_tablet as $item) : ?>
                                <div class="col-md-3 mb-3">
                                    <div class="list-product text-center border border-dark rounded">
                                        <div class="add-list">
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <button class="rounded-circle" onclick="return alert('Sản phẩm hiện tại không còn hàng')">ADD</button>
                                            <?php else : ?>
                                                <button onclick="addCart(event)" class="rounded-circle" id="add-cart" id_product="<?php echo $item['product_id'] ?>">ADD</button>
                                            <?php endif; ?>
                                            <?php if ($item['quantity'] < 1) : ?>
                                                <a onclick="return alert('Sản phẩm hiện tại không còn hàng')">MUA</a>
                                            <?php else : ?>
                                                <a href="?mod=product&action=add_cart&id=<?php echo $item['product_id'] ?>">MUA</a>
                                            <?php endif; ?>
                                        </div>
                                        <div id="img-product-size">
                                            <img class="img-fluid img-thumbnail border-0" src="admin/img/<?php echo $item['product_thumb'] ?>" alt="">
                                        </div>
                                        <div class="type-product bg-primary">
                                            <p class="text-white m-auto"><img class="img-fluid img-thumbnail border-0 bg-transparent" src="img/giftbox.png" alt="">Giảm thêm đến 300k </p>
                                        </div>
                                        <div class="border-top">
                                            <a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>" class="text-dark text-decoration-none"><strong><?php echo $item['product_name'] ?></strong></a>
                                            <div id="text-price" class="d-flex">
                                                <p class="text-danger ml-2 font-weight-bold"><?php echo currency_format($item['price']) ?></p>
                                                <p class="text-black-50 mr-2"><del><?php echo currency_format($item['price'] + ($item['price'] * 0.2)) ?></del>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- End phần máy tính bảng  -->
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>