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
                <li class="breadcrumb-item active">Giỏ hàng</li>
            </nav>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="?mod=cart&action=num_order" method="post"> <!-- Form ở đây -->
                    <div class="table-responsive-sm">
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>MÃ SẢN PHẨM</th>
                                    <th>ẢNH SẢN PHẨM</th>
                                    <th>TÊN SẢN PHẨM</th>
                                    <th>GIÁ SẢN PHẨM</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th colspan="2">THÀNH TIỀN</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                <?php if (!empty($_SESSION['cart']['buy'])) : ?>
                                    <?php foreach ($_SESSION['cart']['buy'] as $item) : ?>
                                        <tr class="border-bottom">
                                            <td><?php echo $item['product_code'] ?></td>
                                            <td>
                                                <a href="">
                                                    <img class="img-fluid img-thumbnail" style="width: 98px;" src="admin/img/<?php echo $item['product_thumb'] ?>" alt="">
                                                </a>
                                            </td>
                                            <td><a href="<?php echo "san-pham/chi-tiet/" . create_slug($item['product_name']) . "/" . $item['product_id'] . ".html"; ?>" class="text-decoration-none"><?php echo $item['product_name'] ?></a></td>
                                            <td class="text-danger"><?php echo currency_format($item['price']) ?></td>
                                            <td>
                                                <input type="number" name="qty[<?php echo $item['product_id'] ?>]" min="1" max="<?php echo $item['max_quantity']?>" value="<?php echo $item['qty'] ?>">
                                            </td>
                                            <td class="text-danger"><?php echo currency_format($item['sub_total']) ?></td>
                                            <td>
                                                <a href="<?php echo $item['url_delete'] ?>&qty_delete=<?php echo $item['qty'] ?>">
                                                    <img src="img/delete.png" alt="">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                    <p><a class="text-decoration-none" href="trang-chu.html">Mua tiếp</a></p>
                    <p><a class="text-decoration-none text-danger" href="?mod=cart&action=deleteAll">Xóa giỏ hàng</a></p>
                </div>
                <?php if (!empty($_SESSION['cart']['buy'])) : ?>
                    <div class="float-right">
                        <h5>TỔNG GIÁ: <span class="text-danger float-right"><?php echo currency_format(cart_info()['total']) ?></span></h5>
                        <button type="submit" name="num_order" class="btn btn-primary btn-lg float-left mr-3">CẬP NHẬT</button>
                        </form>
                        <a class="btn btn-primary btn-lg float-right" href="thanh-toan.html">THANH TOÁN</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- End content  -->

<?php
get_footer();
?>