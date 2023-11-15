<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">QUẢN LÝ BÌNH LUẬN SẢN PHẨM: <strong><?php echo $product['product_name'] ?></strong></h3>
        </div>
        <div class="breadcrumb">
            <li class="breadcrumb-item"><a href="?mod=product&action=list_comments&id=<?php echo $_GET['id'] ?>" class="text-decoration-none">Tất cả(<?php echo count($list_comments) ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=product&action=list_comments&id=<?php echo $_GET['id'] ?>&status=new" class="text-decoration-none">Bình luận mới nhất</a></li>
            <li class="breadcrumb-item"><a href="?mod=product&action=list_comments&id=<?php echo $_GET['id'] ?>&status=old" class="text-decoration-none">Bình luận cũ nhất</a></li>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <form action="" class="form-group ml-2" method="post">
                <select name="action" id="action" class="form-control-sm form-check-inline">
                    <option value="">Tác vụ</option>
                    <option value="1">Xóa</option>
                </select>
                <button class="btn btn-sm btn-success" type="submit" name="btn_apply">Áp dụng</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                            <th>STT</th>
                            <th>Người bình luận</th>
                            <th style="width: 45%;">Nội dung bình luận</th>
                            <th style="width: 15%;">Đánh giá sản phẩm</th>
                            <th>Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_comments)) :
                            $count = 0;
                            foreach ($list_comments as $item) :
                                $count++;
                        ?>
                                <tr>
                                    <td><input type="checkbox" name="checkitem[<?php echo $item['id_comment'] ?>]" id="checkbox" value="<?php echo $item['id_comment'] ?>" class="checkItem"></td>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $item['creator'] ?></td>
                                    <td class="w-50"><?php echo $item['comment_content'] ?></td>
                                    <td><?php echo str_repeat("<img src='public/img/sao.png' alt=''>", $item['star']); ?></td>
                                    <td><?php echo $item['time'] ?></td>
                                    <td class="list-inline">
                                        <a onclick="return confirm('Bạn chắc muốn xóa sản phẩm không')" href="?mod=product&action=delete_comments&id=<?php echo $item['id_product'] ?>&delete=<?php echo $item['id_comment'] ?>" title="Xóa"><img src="public/img/delete1.png" alt=""></a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td class="text-center" colspan="7">Không có bình luận</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>