<?php
get_header();
?>
<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">Thanh toán</h3>
                        <div class="breadcrumb__list">
                            <span><a href="trang-chu.html">Trang chủ</a></span>
                            <span><a href="thanh-toan.html">Thanh toán</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- checkout area start -->
    <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="tp-checkout-bill-area">
                        <h3 class="tp-checkout-bill-title">Chi tiết thanh toán</h3>

                        <div class="tp-checkout-bill-form">
                            <form action="" method="post">
                                <div class="tp-checkout-bill-inner">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="tp-checkout-input">
                                                <label for="fullname">Họ và tên<span>*</span></label>
                                                <input type="text" name="fullname" id="fullname" placeholder="Eg: Nguyễn Văn A" value="<?php echo $customer_info['fullname'] ?>">
                                                <?php echo form_error("fullname") ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tp-checkout-input">
                                                <label for="phone">Số diện thoại <span>*</span></label>
                                                <input type="text" name="phone" id="phone" placeholder="Độ dài 10 số" value="<?php echo $customer_info['phone_number'] ?>">
                                                <?php echo form_error("phone") ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label for="email">Email <span>*</span></label>
                                                <input type="text" name="email" id="email" placeholder="Eg: nguyenvana@gmail.com" value="<?php echo $customer_info['email'] ?>">
                                                <?php echo form_error("email") ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label for="address">Địa chỉ <span>*</span></label>
                                                <input type="text"  name="address" id="address" placeholder="Eg: Hà Nội" value="<?php echo $customer_info['address'] ?>">
                                                <?php echo form_error("address") ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tp-checkout-input">
                                                <label>Ghi chú</label>
                                                <textarea name="note" id="note" placeholder="Những thông tin bạn cần ghi chú về đặt hàng!"></textarea>
                                                <?php echo form_error("note") ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- checkout place order -->
                    <div class="tp-checkout-place white-bg">
                        <h3 class="tp-checkout-place-title">Đơn hàng của bạn</h3>

                        <div class="tp-order-info-list">
                            <ul>

                                <!-- header -->
                                <li class="tp-order-info-list-header">
                                    <h4>Sản phẩm</h4>
                                    <h4>Tổng</h4>
                                </li>
                                <?php
                                if (!empty(cart_buy())) :
                                    foreach (cart_buy() as $item) : ?>
                                        <li class="tp-order-info-list-desc">
                                            <p><?php echo $item['product_name'] ?>. <span> x <?php echo $item['qty'] ?></span></p>
                                            <span><?php echo currency_format($item['price']) ?></span>
                                        </li>
                                <?php endforeach;
                                endif; ?>
                                <!-- subtotal -->
                                <li class="tp-order-info-list-subtotal">
                                    <span>Tổng tiền</span>
                                    <span><?php if (!empty(cart_buy())) echo currency_format(cart_info()['total']) ?></span>
                                </li>

                                <!-- shipping -->
                                <li class="tp-order-info-list-shipping">
                                    <span>Shipping</span>
                                    <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                                        <span>
                                            <input id="flat_rate" type="radio" name="shipping">
                                            <label for="flat_rate">Giao hàng siêu tốc: <span>100.000đ</span></label>
                                        </span>
                                        <span>
                                            <input id="local_pickup" type="radio" name="shipping">
                                            <label for="local_pickup">Giao hàng nhanh: <span>50.000đ</span></label>
                                        </span>
                                        <span>
                                            <input id="free_shipping" type="radio" name="shipping">
                                            <label for="free_shipping">Miễn phí vận chuyển</label>
                                        </span>
                                    </div>
                                </li>

                                <!-- total -->
                                <li class="tp-order-info-list-total">
                                    <span>Total</span>
                                    <span>$1,476.00</span>
                                </li>
                            </ul>
                        </div>
                        <div class="tp-checkout-payment">
                            <div class="tp-checkout-payment-item">
                                <input type="radio" id="back_transfer" name="payment">
                                <label for="back_transfer" data-bs-toggle="direct-bank-transfer">Thanh toán khi nhận hàng</label>
                                <div class="tp-checkout-payment-desc direct-bank-transfer">
                                    <p>Thanh toán khi nhận hàng (COD - Cash On Delivery) là phương thức thanh toán mà người mua hàng sẽ thanh toán số tiền mua hàng trực tiếp cho người giao hàng khi nhận được sản phẩm. </p>
                                </div>
                            </div>
                            <div class="tp-checkout-payment-item paypal-payment">
                                <input type="radio" id="paypal" name="payment">
                                <label for="paypal">Thanh toán Momo <img height="40px" width="40px" src="img/icon-52bd5808cecdb1970e1aeec3c31a3ee1.png" alt=""></label>
                            </div>
                            <div class="tp-checkout-payment-item paypal-payment">
                                <input type="radio" id="paypal" name="payment">
                                <label for="paypal">Thanh toán VnPay <img height="40px" width="40px" src="img/19222904_308450352935921_8689351082334351995_o.jpg" alt=""></label>
                            </div>
                        </div>
                        <div class="tp-checkout-agree">
                            <div class="tp-checkout-option">
                                <input id="read_all" type="checkbox">
                                <label for="read_all">Tôi đã đọc và đồng ý với trang web.</label>
                            </div>
                        </div>
                        <div class="tp-checkout-btn-wrapper">
                            <input type="submit" name="order_buy" class="tp-checkout-btn w-100" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout area end -->
    <form action="?mod=cart&action=checkoutMomo" method="post">
        <button type="submit" name="payUrl">Thanh toán Momo</button>
    </form>

</main>
<?php
get_footer();
?>