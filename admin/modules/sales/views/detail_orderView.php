<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h6>THÔNG TIN ĐƠN HÀNG</h6>
                    <div class="list-group">
                        <div class="list-group-item">
                            <h6><img src="public/img/bar-code.png" alt=""> Mã đơn hàng</h6>
                            <p><?php echo $detail_order['order_code'] ?></p>
                        </div>
                        <div class="list-group-item">
                            <h6><img src="public/img/gps.png" alt=""> Địa chỉ nhận hàng</h6>
                            <p><?php echo $detail_order['address'] ?> / <?php echo $detail_order['phone'] ?></p>
                        </div>
                        <div class="list-group-item">
                            <h6><img src="public/img/shopping-cart.png" alt=""> Thông tin vận chuyển</h6>
                            <p>Thanh toán khi nhận hàng</p>
                        </div>
                        <div class="list-group-item">
                            <h6><img src="public/img/clipboard.png" alt=""> Tình trạng đơn hàng</h6>
                            <form method="POST" action="" class="form-inline">
                                <select name="status" class="form-control">
                                    <option value='Chờ xét duyệt' <?php if ($detail_order['status'] == "Chờ xét duyệt") echo "selected"; ?>>Chờ xét duyệt</option>
                                    <option value='Đang vận chuyển' <?php if ($detail_order['status'] == "Đang vận chuyển") echo "selected"; ?>>Đang vận chuyển</option>
                                    <option value='Thành công' <?php if ($detail_order['status'] == "Thành công") echo "selected"; ?>>Thành công</option>
                                </select>
                                <input type="submit" class="btn btn-primary ml-2" name="sm_status" value="Cập nhật đơn hàng">
                            </form>
                        </div>
                    </div>
                    <h6>SẢN PHẨM ĐƠN HÀNG</h6>
                    <table class="table table-striped">
                        <thead>
                            <tr class="thead-dark">
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list_product)) :
                                $count = 0;
                                foreach ($list_product as $product) :
                            ?>
                                    <tr>
                                        <td><?php echo ++$count; ?></td>
                                        <td>
                                            <img id="img-list-product" class="img-fluid img-thumbnail" src="img/<?php echo $product['product_thumb'] ?>" alt="">
                                        </td>
                                        <td><?php echo $product['product_name'] ?></td>
                                        <td><?php echo currency_format($product['price']) ?></td>
                                        <td><?php echo $product['qty'] ?></td>
                                        <td><?php echo currency_format($product['sub_total']) ?></td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <h6>GIÁ TRỊ ĐƠN HÀNG</h6>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Tổng số lượng:</strong> <?php echo $detail_order['quantity'] ?> sản phẩm</p>
                    <p><strong>Tổng thanh toán:</strong> <span class="text-danger h6"><?php echo currency_format($detail_order['total_price']) ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>