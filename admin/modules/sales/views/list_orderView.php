<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DANH SÁCH ĐƠN HÀNG</h3>
        </div>
        <div class="breadcrumb">
            <li class="breadcrumb-item"><a href="?mod=sales&action=list_order" class="text-decoration-none">Tất cả (<?php echo $num_orders ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=sales&action=list_order&status=Chờ xét duyệt" class="text-decoration-none">Chờ xét duyệt(<?php echo $num_posts_pending ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=sales&action=list_order&status=Đang vận chuyển" class="text-decoration-none">Đang vận chuyển(<?php echo $num_orders_delivery ?>)</a>
            </li>
            <li class="breadcrumb-item"><a href="?mod=sales&action=list_order&status=Thành công" class="text-decoration-none">Thành công(<?php echo $num_orders_success ?>)</a></li>
            <li class="breadcrumb-item">Số sản phẩm đã bán: <?php echo $total_order['total'] ?> sản phẩm</li>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <form action="" class="form-group ml-2" method="post">
                <select name="action" id="action" class="form-control-sm form-check-inline">
                    <option value="">Tác vụ</option>
                    <option value="1">Xóa</option>
                    <option value="2">Thành công</option>
                    <option value="3">Chờ xét duyệt</option>
                    <option value="4">Đang vận chuyển</option>
                </select>
                <button class="btn btn-sm btn-success" type="submit" name="btn_apply">Áp dụng</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th colspan="2">Họ và tên</th>
                            <th>Số sản phẩm</th>
                            <th>Tổng giá</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_order)) :
                            $count = $start;
                            foreach ($list_order as $item) :
                        ?>
                                <tr>
                                    <td><input type="checkbox" name="checkitem[<?php echo $item['id'] ?>]" id="checkbox" value="<?php echo $item['id'] ?>" class="checkItem"></td>
                                    <td><?php echo ++$count; ?></td>
                                    <td><?php echo $item['order_code'] ?></td>
                                    <td><?php echo $item['fullname'] ?></a></td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc muốn xóa đơn hàng không')" href="?mod=sales&action=delete_order&id=<?php echo $item['id'] ?>"><img src="public/img/delete1.png" alt="" title="Xóa"></a>
                                    </td>
                                    <td><?php echo $item['quantity'] ?></td>
                                    <td><?php echo currency_format($item['total_price']) ?></td>
                                    <td><?php echo $item['status'] ?></td>
                                    <td><?php echo $item['time'] ?></td>
                                    <td><a href="?mod=sales&action=detail_order&id=<?php echo $item['id'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="card-footer clearfix">
            <?php
            echo get_padding($num_rows) ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>