<?php
get_header();
?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"><img src="img/check.png" class="img-fluid img-thumbnail border-0 bg-transparent" alt="">Đơn hàng của bạn đã được
                    xử lý!</h1>
                <table class="table text-center">
                    <thead class="thead-dark ">
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if (!empty($list_products)) :
                            $count = 0;
                            foreach ($list_products as $item) :
                        ?>
                                <tr class="border-bottom">
                                    <td><?php echo ++$count; ?></td>
                                    <td>
                                        <img style="width: 60px;" class="img-fluid img-thumbnail" src="admin/img/<?php echo $item['product_thumb'] ?>" alt="">
                                    </td>
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td class="text-danger"><?php echo currency_format($item['price']) ?></td>
                                    <td><?php echo $item['qty'] ?></td>
                                    <td class="text-danger"><?php echo currency_format($item['sub_total']) ?></td>
                                </tr>
                        <?php endforeach;
                        else : echo "<td colspan='6'>KHÔNG CÓ SẢN PHẨM</td>";
                        endif; ?>
                        <tr>
                            <td colspan="3" class="h5">TỔNG TIỀN THANH TOÁN</td>
                            <td colspan="3" class="h5 text-danger"><?php if (!empty($total)) echo currency_format($total) ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>Cảm ơn bạn đã mua hàng của chúng tôi. Đơn hàng của bạn đã được tiếp nhận xử lý và sẽ được giao trong thời gian sớm nhất.</p>
                <p>Thông tin đơn hàng: Được gửi đến gmail của bạn <a href="https://accounts.google.com/" class="text-decoration-none" title="đăng nhập gmail ở đây">Tại đây</a></p>
                <a href="trang-chu.html" class="btn btn-lg btn-danger">Tiếp tục mua hàng</a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>