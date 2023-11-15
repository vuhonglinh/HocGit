<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DANH SÁCH TRANG</h3>
        </div>
        <div class="breadcrumb">
            <li class="breadcrumb-item"><a href="?mod=page&action=list_page" class="text-decoration-none">Tất cả(<?php echo count($list_page); ?>)</a></li>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <form action="" class="form-group" method="post">
                <select name="action" id="action" class="form-control-sm form-check-inline">
                    <option value="">Tác vụ</option>
                    <option value="1">Xóa</option>
                </select>
                <button class="btn btn-sm btn-success" type="submit" name="btn_apply">Áp dụng</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                            <th style="width: 10px">STT</th>
                            <th style="width: 40%px;">Tên trang</th>
                            <th>Người tạo</th>
                            <th>Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_page)) :
                            $count = $start;
                            foreach ($list_page as $item) :
                        ?>
                                <tr>
                                    <td><input type="checkbox" name="checkitem[<?php echo $item['page_id'] ?>]" id="checkbox" value="<?php echo $item['page_id'] ?>" class="checkItem"></td>
                                    <td><?php echo ++$count; ?></td>
                                    <td><?php echo $item['page_title'] ?></td>

                                    <td><?php echo $item['creator'] ?></td>
                                    <td><?php echo $item['created_date'] ?></td>
                                    <td>
                                        <a href="?mod=page&action=update_page&id=<?php echo $item['page_id'] ?>" class="text-decoration-none" title="Sửa">
                                            <img src="public/img/pen (1).png" alt="">
                                        </a>
                                        <a onclick="return confirm('Bạn chắc muốn xóa sản phẩm không')" href="?mod=page&action=delete_page&id=<?php echo $item['page_id'] ?>" class="text-decoration-none" title="Xóa">
                                            <img src="public/img/delete1.png" alt="">
                                        </a>
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
            echo get_padding($num_rows);
            ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?php
get_footer();
?>