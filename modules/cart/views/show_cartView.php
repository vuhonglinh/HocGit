<?php
get_header();
$username = $_SESSION['user_login'];
echo $username;
?>
<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">Giỏ hàng</h3>
                        <div class="breadcrumb__list">
                            <span><a href="trang-chu.html">Trang chủ</a></span>
                            <span><a href="gio-hang.html">Giỏ hàng</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- cart area start -->
    <section class="tp-cart-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="tp-cart-list mb-25 mr-30">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2" class="tp-cart-header-product">Sản phẩm</th>
                                    <th class="tp-cart-header-price">Giá</th>
                                    <th class="tp-cart-header-quantity">Số lượng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['cart']['buy'])) : ?>
                                    <?php foreach ($_SESSION['cart']['buy'] as $item) : ?>
                                        <tr>
                                            <!-- img -->
                                            <td class="tp-cart-img"><a href="product-details.html"> <img src="admin/img/<?php echo $item['product_thumb'] ?>" alt=""></a></td>
                                            <!-- title -->
                                            <td class="tp-cart-title"><a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>"><?php echo $item['product_name'] ?></a></td>
                                            <!-- price -->
                                            <td class="tp-cart-price"><span><?php echo currency_format($item['price']) ?></span></td>
                                            <!-- quantity -->
                                            <td class="tp-cart-quantity">
                                                <div class="tp-product-quantity mt-10 mb-10">
                                                    <input type="number" name="qty[<?php echo $item['product_id'] ?>]" min="1" max="" value="<?php echo $item['qty'] ?>">
                                                </div>
                                            </td>
                                            <!-- action -->
                                            <td class="tp-cart-action">
                                                <a href="<?php echo $item['url_delete'] ?>" class="tp-cart-action-btn">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 1.53033C9.82322 1.23744 9.82322 0.762563 9.53033 0.46967C9.23744 0.176777 8.76256 0.176777 8.46967 0.46967L5 3.93934L1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L3.93934 5L0.46967 8.46967C0.176777 8.76256 0.176777 9.23744 0.46967 9.53033C0.762563 9.82322 1.23744 9.82322 1.53033 9.53033L5 6.06066L8.46967 9.53033C8.76256 9.82322 9.23744 9.82322 9.53033 9.53033C9.82322 9.23744 9.82322 8.76256 9.53033 8.46967L6.06066 5L9.53033 1.53033Z" fill="currentColor" />
                                                    </svg>
                                                    <span>Remove</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else :
                                    echo "<tr><td  colspan='7'>KHÔNG CÓ SẢN PHẨM NÀO</td></tr>";
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tp-cart-bottom">
                        <div class="row align-items-end">
                            <div class="col-xl-6 col-md-8">
                                <div class="tp-cart-coupon">
                                    <form action="#">
                                        <div class="tp-cart-coupon-input-box">
                                            <label>Mã giảm giá:</label>
                                            <div class="tp-cart-coupon-input d-flex align-items-center">
                                                <input type="text" placeholder="Sử dụng mã nếu có">
                                                <button type="submit">Áp dụng</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-4">
                                <div class="tp-cart-update text-md-end">
                                    <button type="button" class="tp-cart-update-btn">Cập nhật giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="tp-cart-checkout-wrapper">
                        <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                            <span class="tp-cart-checkout-top-title">Tổng tiền</span>
                            <span class="tp-cart-checkout-top-price"><?php echo currency_format(cart_info()['total']) ?></span>
                        </div>
                        <div class="tp-cart-checkout-shipping">
                            <h4 class="tp-cart-checkout-shipping-title">Vận chuyển hàng</h4>

                            <div class="tp-cart-checkout-shipping-option-wrapper">
                                <div class="tp-cart-checkout-shipping-option">
                                    <input id="flat_rate" type="radio" name="shipping">
                                    <label for="flat_rate">Giao hàng siêu tốc: <span>$20.00</span></label>
                                </div>
                                <div class="tp-cart-checkout-shipping-option">
                                    <input id="local_pickup" type="radio" name="shipping">
                                    <label for="local_pickup">Giao hàng nhanh: <span> $25.00</span></label>
                                </div>
                                <div class="tp-cart-checkout-shipping-option">
                                    <input id="free_shipping" type="radio" name="shipping">
                                    <label for="free_shipping">Giao hàng tích kiệm: <span> $25.00</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                            <span>Thanh toán</span>
                            <span>$724</span>
                        </div>
                        <div class="tp-cart-checkout-proceed">
                            <a href="thanh-toan.html" class="tp-cart-checkout-btn w-100">Tiến hành đặt hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart area end -->

</main>

<!-- End content  -->
<?php
get_footer();
?>