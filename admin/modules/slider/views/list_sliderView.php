<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DANH SÁCH SLIDER</h3>
        </div>
        <div class="breadcrumb">
            <li class="breadcrumb-item"><a href="?mod=slider&action=list_slider" class="text-decoration-none">Tất cả(<?php echo $num_slider ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=slider&action=list_slider&status=Đã đăng" class="text-decoration-none">Đã đăng(<?php echo $num_slider_posted ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=slider&action=list_slider&status=Chờ xét duyệt" class="text-decoration-none">Chờ xét duyệt(<?php echo $num_slider_pending ?>)</a>
            </li>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <form action="" class="form-group ml-2" method="post">
                <select name="action" id="action" class="form-control-sm form-check-inline">
                    <option value="">Tác vụ</option>
                    <option value="1">Xóa</option>
                    <option value="2">Đã đăng</option>
                    <option value="3">Chờ xét duyệt</option>
                </select>
                <button class="btn btn-sm btn-success" type="submit" name="btn_apply">Áp dụng</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Link</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Người tạo</th>
                            <th>Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_slider)) :
                            $count = 0;
                            foreach ($list_slider as $item) :
                        ?>
                                <tr>
                                    <td><input type="checkbox" name="checkitem[<?php echo $item['slider_id'] ?>]" id="checkbox" value="<?php echo $item['slider_id'] ?>" class="checkItem"></td>
                                    <td><?php echo ++$count; ?></td>
                                    <td>
                                        <img id="img-list-product" class="img-fluid img-thumbnail" src="img/<?php echo $item['slider_img']; ?>" alt="">
                                    </td>
                                    <td><?php echo $item['link'] ?></td>
                                    <td><?php echo $item['number_order'] ?></td>
                                    <td><?php echo $item['status'] ?></td>
                                    <td><?php echo $item['creator'] ?></td>
                                    <td><?php echo $item['created_date'] ?></td>
                                    <td>
                                        <a href="?mod=slider&action=update_slider&id=<?php echo $item['slider_id'] ?>" title="Sửa"><img src="public/img/pen (1).png" alt=""></a>
                                        <a onclick="return confirm('Bạn chắc muốn xóa sản phẩm không')" href="?mod=slider&action=delete_slider&id=<?php echo $item['slider_id'] ?>" title="Xóa"><img src="public/img/delete1.png" alt=""></a>
                                    </td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="card-footer clearfix">
            <?php
            echo get_padding($num_rows)
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>