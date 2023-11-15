<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AUTO SMART</title>
    <base href="<?php echo base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/index.css">
    <script src="public/js/app.js" text="type/javascript"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (is_login()) : ?>
                                <a href="?mod=users&action=index" title="" id="payment-link" class="text-light float-left mt-3 text-decoration-none">Xin chào <?php echo info_login() ?></a>
                            <?php endif; ?>
                            <nav class="navbar navbar-expand-xl float-right">
                                <div class="collapse navbar-collapse " id="main-nav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a href="trang-chu.html" class="nav-link text-light">TRANG CHỦ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="san-pham.html" class="nav-link text-light">SẢN PHẨM</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="bai-viet.html" class="nav-link text-light">BLOG</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="gioi-thieu-1.html" class="nav-link text-light">GIỚI THIỆU</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="lien-he-2.html" class="nav-link text-light">LIÊN HỆ</a>
                                        </li>
                                        <?php if (is_login()) : ?>
                                            <li class="nav-item">
                                                <a href="?mod=log&action=logout" class="nav-link text-light"><img src="img/logout.png" alt=""></a>
                                            </li>
                                        <?php else : ?>
                                            <li class="nav-item">
                                                <a href="?mod=log&action=login" class="nav-link text-light"><img src="img/login.png" alt=""></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 ">
                            <a href="trang-chu.html">
                                <img width="100px" class="img-fluid img-thumbnail bg-transparent border-0" src="img/Group 43.png" alt="">
                            </a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <form method="post" action="?mod=product&action=seach" class="form-inline">
                                <input type="text" name="seach" id="" class="form-control w-75" placeholder="Nhập tên sản phẩm cần tìm...">
                                <button class="btn btn-group bg-light ml-2">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div id="advisory-wp" class="fl-left">
                                <img src="img/call.png" alt="">
                                <span class="title text-light">Tư vấn</span>
                                <span class="phone text-light"><strong>0987.654.321</strong></span>
                            </div>
                        </div>
                        <div class="col-md-1 mt-3">
                            <h5 id="menu-total-cart" class="text-danger font-weight-bold"><?php echo !empty($_SESSION['cart']['buy']) ? count($_SESSION['cart']['buy']) : 0; ?></h5>
                            <button class="btn bg-transparent position-relative" data-toggle="modal" data-target="#demo-modal">
                                <img class="img-fluid" src="img/shopping-bag.png" alt="">
                            </button>
                            <div class="modal fade" id="demo-modal">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="text-center">Giỏ hàng</h5>
                                        </div>
                                        <div class="modal-body box overflow-auto" id="list_add_cart">
                                            <!-- Dánh sách sản phẩm trong giỏ hàng -->
                                            <?php if (!empty($_SESSION['cart']['buy'])) : ?>
                                                <?php foreach ($_SESSION['cart']['buy'] as $item) : ?>
                                                    <div class="media border-bottom">
                                                        <a href="">
                                                            <img src="admin/img/<?php echo $item['product_thumb'] ?>" class="img-fluid img-thumbnail border-0 mr-3" style="height: 80px;" alt="">
                                                        </a>
                                                        <div class="media-body">
                                                            <a class="text-decoration-none" id="mane-product" href=""><?php echo $item['product_name'] ?></a>
                                                            <div class="d-flex">
                                                                <p class="text-danger float-left" style="font-size: 12px;"><?php echo currency_format($item['price']) ?></p>
                                                            </div>
                                                        </div>
                                                        <p class="text-black-50">Số lượng X <?php echo $item['qty']; ?></p>
                                                    </div>
                                            <?php endforeach;
                                            endif; ?>
                                        </div>
                                        <div class="text-justify">
                                            <h5 class="float-left ml-2">Tổng tiền:</h5>
                                            <h5 class="float-right mr-2 text-danger"><?php echo !empty($_SESSION['cart']['buy']) ? currency_format($_SESSION['cart']['info']['total']) : null ?></h5>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="gio-hang.html" class="btn btn-danger" data-dismis="modal">Giỏ hàng</a>
                                            <?php if (!empty($_SESSION['cart']['buy'])) :  ?>
                                                <a href="thanh-toan.html" class="btn btn-success" data-dismis="modal">Thanh toán</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End cart  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End header -->