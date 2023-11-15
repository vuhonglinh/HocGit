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
                <li class="breadcrumb-item active">Thanh toán</li>
            </nav>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="border-bottom">THÔNG TIN KHÁCH HÀNG</h5>
                <form action="" method="post">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo set_value("fullname") ?>">
                                <?php echo form_error("fullname") ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value("email") ?>">
                                <?php echo form_error("email") ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo set_value("address") ?>">
                                <?php echo form_error("address") ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value("phone") ?>">
                                <?php echo form_error("phone") ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Ghi chú</label>
                                <textarea class="form-control" name="note" id="note" cols="30" rows="10"><?php echo set_value("note") ?></textarea>
                                <?php echo form_error("note") ?>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="col-md-6">
                <h5 class="border-bottom">THÔNG TIN ĐƠN HÀNG</h5>
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty(cart_buy())) :
                            foreach (cart_buy() as $item) : ?>
                                <tr class="border-bottom">
                                    <td class="float-left text-dark"><?php echo $item['product_name'] ?> <span class="text-black-50">X
                                            <?php echo $item['qty'] ?></span></td>
                                    <td>
                                        <p class="text-danger float-right">240,900,000đ</p>
                                    </td>
                                </tr>
                        <?php endforeach;
                        endif; ?>

                        <tr>
                            <td class="h6 float-left">TỔNG ĐƠN HÀNG:</td>
                            <td>
                                <p class="h5 text-danger float-right"><?php if (!empty(cart_buy())) echo currency_format(cart_info()['total']) ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <input type="radio" name="" id="" checked>Thanh toán khi nhận hàng
                </div>
                <input type="submit" name="order_buy" class="btn btn-primary btn-lg my-4" id="order-now" value="Đặt hàng">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End content  -->
<?php
get_footer();
?>