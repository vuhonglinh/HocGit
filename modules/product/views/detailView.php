<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" href="">Sản phẩm</a>
                </li>
                <li class="breadcrumb-item active">Sản phẩm <?php echo $product['product_name'] ?> (<?php echo $product['sales'] ?> sản phẩm đã được bán)</li>
            </nav>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="w-100 mb-1">
                <a class="share float-right btn-sm btn-primary text-decoration-none" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $product_share['url']; ?>&picture=<?php echo $product_share['img']; ?>" target="_blank">Chia sẻ</a>
            </div>
            <div class="col-md-12 border-danger" id="header-product">
                <div class="row">
                    <div class="col-md-7 my-3 position-relative border-right">
                        <div id="thumb-now" class="position-relative">
                            <div id="thumb-now-parent">
                                <button onclick="prevBtn(event)" class="border-0 bg-transparent" id="btn-img-prev"><img class="img-fluid img-thumbnai" src="img/sau-anh.png" alt=""></button>
                                <button onclick="nextBtn(event)" class="border-0 bg-transparent" id="btn-img-next"><img class="img-fluid img-thumbnai" src="img/truoc-anh.png" alt=""></button>
                                <img id="thumb-img-now" road="1" class="img-fluid img-thumbnail border-0" src="admin/img/<?php echo $product['product_thumb'] ?>" />
                            </div>
                        </div>
                        <div class="mt-4 child-img">
                            <?php foreach ($list_img_detail as $item) : ?>
                                <img id="ride-thumb" class="img-thumbnail" src="admin/img/<?php echo $item['image'] ?>" alt="">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3">
                        <form action="?mod=cart&action=add_cart&id=<?php echo $product['product_id'] ?>" method="post">
                            <p class="h4" id="product_name"><?php echo $product['product_name'] ?></p>
                            <div class="pt-2 border-top">
                                <?php echo $product['product_desc'] ?>
                            </div>
                            <div class="my-3">
                                <?php if (!empty($variant_color)) : ?>
                                    <span class="color">Màu sắc: </span>
                                    <select name="color" id="color">
                                        <option value="">---Chọn---</option>
                                        <?php foreach ($variant_color as $item) : ?>
                                            <option <?php if ($item['quantity'] == 0) echo "disabled" ?> value="<?php echo $item['id'] ?>"><?php echo $item['color_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif ?>
                                <?php if (!empty($variant_ram)) : ?>
                                    <span class="ram">Dung lượng: </span>
                                    <select name="ram" id="ram" onchange="selectColor(this)" product_id="<?php echo $product['product_id'] ?>">
                                        <option value="">---Chọn---</option>
                                        <?php foreach ($variant_ram as $item) : ?>
                                            <option <?php if ($item['quantity'] == 0) echo "disabled" ?> value="<?php echo $item['id'] ?>"><?php echo $item['nemory_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif ?>
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="bg-danger text-white p-1">Hết hàng</span>
                            </div>
                            <p class="h3 text-danger mt-3" id="product_price"><?php echo currency_format($product['price']) ?></p>
                            <div class="d-flex" id="quantity">
                            </div>
                            <button type="submit" title="Thêm giỏ hàng" class="btn btn-primary my-3 btn-lg">Thêm giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function selectColor(_this) {
                var product_id = $(_this).attr("product_id");
                var color = $("#color").val();
                var ram = $(_this).val();
                var data = {
                    product_id: product_id,
                    ram: ram,
                    color: color
                }
                $.ajax({
                    url: '?mod=product&action=detail_ajax',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        $("#product_name").html(data.product_name);
                        $("#product_price").html(data.price);
                        $("#quantity").html(data.quantity);
                    }
                })
            }
        </script>
        <div class="row mt-5 bg-white">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs">
                        <a href="#tabs-content-1" class="nav-link nav-item active" data-toggle="tab">Đánh giá sản phẩm</a>
                        <a href="#tabs-content-2" class="nav-link nav-item" data-toggle="tab">Bình luận sản phẩm</a>
                        <a href="#tabs-content-3" class="nav-link nav-item" data-toggle="tab">Thông tin chi tiết</a>
                    </div>
                </nav>
                <div class="tab-content">
                    <div class="tab-pane show fade active" id="tabs-content-1">
                        <div id="evaluation">
                            <div class="col-md-6 border-right h-100" id="evaluation-item">
                                <h1 class="text-danger"><?php echo number_format($star['star'], 1) ?>/5</h1>
                                <div><?php echo str_repeat("<img src='img/sao.png' alt=''>", round($star['star'])) ?></div>
                                <p class="font-weight-bold">(<?php echo $count ?>) Đánh giá và nhận xét</p>
                            </div>
                            <div class="col-md-6" id="evaluation-item">
                                <div>
                                    <div class="h5">5 <img src='img/sao.png' alt=''>(<?php echo $star_5 ?>) Đánh giá</div>
                                    <div class="h5">4 <img src='img/sao.png' alt=''>(<?php echo $star_4 ?>) Đánh giá</div>
                                    <div class="h5">3 <img src='img/sao.png' alt=''>(<?php echo $star_3 ?>) Đánh giá</div>
                                    <div class="h5">2 <img src='img/sao.png' alt=''>(<?php echo $star_2 ?>) Đánh giá</div>
                                    <div class="h5">1 <img src='img/sao.png' alt=''>(<?php echo $star_1 ?>) Đánh giá</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade bg-white" id="tabs-content-2">
                        <form action="" method="post">
                            <label for="comment" class="h3 float-left">Bình luận</label><br>
                            <div class="star-widget" class="float-left">
                                <input type="radio" name="star" id="rate-5" value="5">
                                <label for="rate-5"></label>
                                <input type="radio" name="star" id="rate-4" value="4">
                                <label for="rate-4"></label>
                                <input type="radio" name="star" id="rate-3" value="3">
                                <label for="rate-3"></label>
                                <input type="radio" name="star" id="rate-2" value="2">
                                <label for="rate-2"></label>
                                <input type="radio" name="star" id="rate-1" value="1">
                                <label for="rate-1"></label>
                            </div>
                            <input type="text" required class="form-control" id_product="<?php echo $product['product_id'] ?>" id="comment" placeholder="Mời bạn bình luận hoặc đặt câu hỏi">
                            <button type="submit" id="add-comment" name="add-comment" class="btn btn-primary mt-3">Gửi</button>
                        </form>

                        <div class="col-md-12 mt-2" id="list_comment">
                            <?php if (!empty($comments)) {
                                foreach ($comments as $item) :
                            ?>
                                    <div id="item-comment">
                                        <div id="header-comment">
                                            <img id="img-user-comment" class="box rounded-circle" src="img/user.png" alt="">
                                            <h6 class="mt-2 ml-1"><?php echo $item['creator'] ?></h6>
                                        </div>
                                        <div>
                                            <?php echo str_repeat("<img src='img/sao.png' alt=''>", $item['star']) ?>
                                        </div>
                                        <div>
                                            <p><?php echo $item['comment_content'] ?></p>
                                        </div>
                                        <div>
                                            <img src="img/oclock.png" alt=""><span class="text-black-50"><?php echo $item['time'] ?></span>
                                        </div>
                                    </div>
                                <?php endforeach;
                            } else {
                                ?>
                                <div class="text-center"><span class="text-black-50">Chưa có bình luận nào</span></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="tab-pane show fade mt-4" id="tabs-content-3"><?php echo $product['product_content'] ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3" id="category-same">
            <div class="col-md-12 my-3">
                <h3 class="text-center">Sản phẩm liên quan</h3>
                <div class="float-right mb-2">
                    <button onclick="prevSlide()" class="float-left border-0"><img class="bg-transparent img-fluid img-thumbnail" src="img/sau.png" alt=""></button>
                    <button onclick="nextSlide()" class="float-right border-0"><img class="bg-transparent img-fluid img-thumbnail" src="img/truoc.png" alt=""></button>
                </div>
                <div id="slick-slider">
                    <?php foreach (list_same_category($product['cat_id']) as $item) :
                    ?>
                        <div class="slide mr-4">
                            <div class="list-product text-center border border-dark rounded">
                                <div class="add-list">
                                    <button onclick="addCart(event)" class="rounded-circle" id="add-cart" id_product="<?php echo $item['product_id'] ?>">ADD</button>
                                    <a href="?mod=product&action=add_cart&id=<?php echo $item['product_id'] ?>">MUA</a>
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
    </div>
</div>
<?php
get_footer();
?>