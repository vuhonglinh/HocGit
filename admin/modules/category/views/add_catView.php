<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">THÊM DANH MUC SẢN PHẨM</h3>
            </div>
            <div class="card-body">
                <form method="POST" class="form-group">
                    <label for="product-name">Tên danh mục</label>
                    <input type="text" name="cat_name" id="product-name" class="form-inline form-control" value="<?php echo set_value('cat_name') ?>"><br>
                    <?php echo form_error('cat_name') ?>
                    <button type="submit" name="add_cat" id="btn-submit" class="btn btn-primary btn-lg mt-4">Thêm mới</button><br>
                    <?php echo form_error('account') ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
