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
                <li class="breadcrumb-item">Sản phẩm</a></li>
            </nav>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 border-danger">
                <div class="list-group">
                    <a href="" class="list-group-item list-group-item-action bg-secondary text-light">DANH MỤC
                        SẢN PHẨM</a>
                    <?php get_sidebar() ?>
                </div>
                <div class="list-group mt-4">
                    <div class="list-group-item list-group-item-action bg-secondary text-light">BỘ LỌC</div>
                    <div class="bg-white">
                        <div class="section-detail">
                            <form method="POST" action="">
                                <table class="table table-active">
                                    <thead>
                                        <tr>
                                            <td class="table-primary" colspan="2">Giá</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="price" value="1"></td>
                                            <td>Dưới 1.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="price" value="2"></td>
                                            <td>1.000.000đ - 5.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="price" value="3"></td>
                                            <td>5.000.000đ - 15.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="price" value="4"></td>
                                            <td>15.000.000đ - 25.000.000đ</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="price" value="5"></td>
                                            <td>Trên 25.000.000đ</td>
                                        </tr>
                                    </tbody>
                                    </tbody>
                                </table>
                                <table class="table table-active">
                                    <thead>
                                        <tr>
                                            <td class="table-primary" colspan="2">Loại</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="radio" name="category" value="1"></td>
                                            <td>Điện thoại</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="category" value="2"></td>
                                            <td>Máy tính bảng</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" name="category" value="3"></td>
                                            <td>Laptop</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-primary btn-sm btn-block" name="select_detail" value="Lọc">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="<?php echo $list_ads['link'] ?>">
                        <img src="admin/img/<?php echo $list_ads['ads_img'] ?>" alt="">
                    </a>
                </div>
                <!-- End quảng cáo -->
            </div>

            <div class="col-md-9 border-danger">
                <div class="row d-flex">
                    <div class="col-md-6">
                        <div class="float-left">
                            <h3 class="font-weight-normal">ĐIỆN THOẠI</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">
                            <p class="">Hiển thị <?php echo count($list_products) ?> sản phẩm</p>
                            <div class="">
                                <form method="POST" action="" class="form-inline">
                                    <select name="select" class="custom-select-sm">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá thấp lên cao</option>
                                        <option value="4">Giá cao xuống thấp</option>
                                    </select>
                                    <button class="btn btn-secondary btn-sm ml-2" type="submit" name="loc">Lọc</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="row">

                            <?php if (!empty($list_products)) :
                                foreach ($list_products as $item) :
                            ?>
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
                            <?php endforeach;
                            else :
                                echo "<h2>Không timg thấy sản phẩm</h2>";
                            endif;
                            ?>

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