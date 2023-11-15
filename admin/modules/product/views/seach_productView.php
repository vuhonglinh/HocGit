<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DANH SÁCH TÌM KIẾM SẢN PHẨM : <strong><?php echo $_GET['seach'] ?></strong></h3>
        </div>
        <?php get_sidebar('product') ?>
        <div class="breadcrumb">
            <li class="breadcrumb-item"><a href="?mod=product&action=list_product" class="text-decoration-none">Tất cả(<?php echo $num_products ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=product&action=list_product&status=Đã đăng" class="text-decoration-none">Đã đăng(<?php echo $num_products_posted ?>)</a></li>
            <li class="breadcrumb-item"><a href="?mod=product&action=list_product&status=Chờ xét duyệt" class="text-decoration-none">Chờ xét duyệt(<?php echo $num_products_pending ?>)</a>
            </li>
            <li class="breadcrumb-item"><a href="?mod=product&controller=delete&action=list_product_delete" class="text-decoration-none">Thùng rác(<?php echo $num_product_delete ?>)</a></li>
            <?php if (!empty($list_cat)) :
                foreach ($list_cat as $item) :
            ?>
                    <li class="breadcrumb-item">
                        <a href="?mod=product&action=list_product&cat_id=<?php echo $item['id'] ?>" class="text-decoration-none"><?php echo $item['title'] ?>(<?php echo num_list_products_by_cat($item['id']) ?>)</a>
                    </li>
            <?php endforeach;
            endif; ?>
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
                            <th>Mã sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th colspan="2">Tên sản phẩm</th>
                            <th>Gía cơ bản</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Số lượt bán</th>
                            <th>Bình luận</th>
                            <th>Người tạo</th>
                            <th>Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_seach)) :
                            $count = 0;
                            foreach ($list_seach as $item) :
                                $count++;
                        ?>
                                <tr>
                                    <td><input type="checkbox" name="checkitem[<?php echo $item['product_id'] ?>]" id="checkbox" value="<?php echo $item['product_id'] ?>" class="checkItem"></td>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $item['product_code'] ?></td>
                                    <td>
                                        <img id="img-list-product" class="img-fluid img-thumbnail" src="img/<?php echo $item['product_thumb'] ?>" alt="">
                                    </td>
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td class="list-inline">
                                        <a href="?mod=product&action=update_product&id=<?php echo $item['product_id'] ?>" title="Sửa"><img src="public/img/pen (1).png" alt=""></a>
                                        <a onclick="return confirm('Bạn chắc muốn xóa sản phẩm không')" href="?mod=product&action=delete_product&id=<?php echo $item['product_id'] ?>" title="Xóa"><img src="public/img/delete1.png" alt=""></a>
                                    </td>             
                                    <td class="text-danger"><?php echo currency_format($item['price']); ?></td>
                                    <td><?php echo $item['title'] ?></td>
                                    <td><?php echo $item['status'] ?></td>
                                    <td><?php echo $item['sales'] ?></td>
                                    <td><a href="?mod=product&action=list_comments&id=<?php echo $item['product_id'] ?>" class="text-decoration-none">Chi tiết</a></td>
                                    <td><?php echo $item['creator'] ?></td>
                                    <td><?php echo $item['created_date'] ?></td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <td colspan="14" class="text-center">Không tìm thấy sản phẩm nào</td>
                        <?php
                        endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>