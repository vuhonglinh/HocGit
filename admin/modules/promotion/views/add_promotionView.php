<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="col-sm-6">
            <h1>THÊM MỚI KHUYỄN MÃI</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" class="form-group">
                    <label for="title">Tên chương trình khuyễn mãi</label>
                    <input class="form-control form-inline" type="text" name="title" id="title" value="<?php echo set_value("title") ?>"><br>
                    <?php echo form_error("title") ?>
                    <label for="description">Mô tả </label>
                    <textarea name="description" id="description" class="ckeditor form-control form-inline"><?php echo set_value("description") ?></textarea><br>
                    <?php echo form_error("description") ?>
                    <div class="form-row">
                        <div class="co-md-6">
                            <label for="startDate">Ngày bắt đầu</label>
                            <input id="startDate" type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" value="<?php echo set_value("startDate") ?>" onchange="updateEndDateMin()" name="startDate">
                        </div>
                        <div class="co-md-6 ml-5">
                            <label for="endDate">Ngày kết thúc</label>
                            <input id="endDate" type="date" min="<?php echo date('Y-m-d') ?>" value="<?php echo set_value("endDate") ?>" class="form-control" name="endDate">
                        </div>
                    </div><br>
                    <?php echo form_error("date") ?>
                    <div class="form-row">
                        <div>
                            <label for="discount_rate">Phần trăm giảm giá</label>
                            <input class="form-control form-inline" type="number" min="1" max="100" name="discount_rate" id="discount_rate" value="<?php echo set_value("discount_rate") ?>"><br>
                        </div>
                    </div><br>
                    <?php echo form_error("discount_rate") ?>
                    <label for="">Danh sách sản phẩm áp dụng</label>
                    <div class="form-row">
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="checkAll" id="checkAll"></th>
                                        <th>STT</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Gía cơ bản</th>
                                        <th>Danh mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($list_products)) :
                                        $count = 0;
                                        foreach ($list_products as $item) :
                                            $count++;
                                    ?>
                                            <tr>
                                                <td><input type="checkbox" name="product_id[<?php echo $item['product_id'] ?>]" id="checkbox" value="<?php echo $item['product_id'] ?>" class="checkItem"></td>
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $item['product_code'] ?></td>
                                                <td>
                                                    <img id="img-list-product" class="img-fluid img-thumbnail" src="img/<?php echo $item['product_thumb'] ?>" alt="">
                                                </td>
                                                <td><?php echo $item['product_name'] ?></td>
                                                <td class="text-danger"><?php echo currency_format($item['price']); ?></td>
                                                <td><?php echo $item['title'] ?></td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <td colspan="14" class="text-center">Không có sản phẩm nào</td>
                                    <?php
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo form_error("check") ?>
                    <button class="btn btn-primary btn-lg my-4" type="submit" name="add_promotions" id="btn-submit">Thêm</button><br>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function updateEndDateMin() {
        // Lấy giá trị của ngày bắt đầu
        var startDate = document.getElementById("startDate").value;

        // Set giá trị ngày kết thúc tối thiểu là ngày bắt đầu
        document.getElementById("endDate").min = startDate;
    }
</script>

<?php
get_footer();
?>