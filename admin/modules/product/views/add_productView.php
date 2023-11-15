<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">THÊM SẢN PHẨM</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" id="imageUploadDetail" class="form-group">
                    <label for="product-name" class="font-weight-bold">Tên sản phẩm</label>
                    <input type="text" name="product_name" id="product-name" class="form-inline form-control" value="<?php echo set_value('product_name') ?>"><br>
                    <?php echo form_error('product_name') ?>
                    <label for="product-code" class="font-weight-bold">Mã sản phẩm</label>
                    <input type="text" name="product_code" id="product-code" class="form-inline form-control" value="<?php echo set_value('product_code') ?>"><br>
                    <?php echo form_error('product_code') ?>
                    <label for="price" class="font-weight-bold">Giá cơ bản</label>
                    <input type="text" name="price" id="price" class="form-inline form-control" value="<?php echo set_value('price') ?>"><br>
                    <?php echo form_error('price') ?>
                    <label for="product_desc" class="font-weight-bold">Mô tả ngắn</label>
                    <textarea name="product_desc" id="product_desc" class="ckeditor"><?php echo set_value('product_desc') ?></textarea><br>
                    <?php echo form_error('product_desc') ?>
                    <label for="product_content" class="font-weight-bold">Chi tiết</label>
                    <textarea name="product_content" id="product_content" class="ckeditor"><?php echo set_value('product_content') ?></textarea><br>
                    <?php echo form_error('product_content') ?>
                    <label class="font-weight-bold">Hình ảnh đại điện</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="public/img/photo.png" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error('file') ?>

                    <label class="font-weight-bold">Hình ảnh chi tiết</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="images[]" multiple="multiple" onchange="uploadImageDetail(event)" class="form-control-file">
                            <div id="detail_images" class="d-flex">
                                <img id="size-img-thumb" src="public/img/photo.png" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error('images') ?>

                    <label class="font-weight-bold">Danh mục sản phẩm</label>
                    <select name="parent_id" class="form-inline form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($list_category as $item) : ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['title'] ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <?php echo form_error('parent_id') ?>
                    <label class="font-weight-bold">Trạng thái</label>
                    <select name="status" class="form-inline form-control">
                        <option value="0">-- Chọn danh mục --</option>
                        <option value="Chờ xét duyệt">Chờ xét duyệt</option>
                        <option value="Đã đăng">Đã đăng</option>
                    </select><br>
                    <?php echo form_error('status') ?>

                    <label class="font-weight-bold h4">Biến thể màu sắc</label>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="create()">Add</a>
                    <div id="color">
                        <div id="item-color" class="form-row justify-content-center align-items-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name_color_var">Tên thuộc tính màu sắc</label>
                                    <input type="text" class="form-control" id="name_color_var" name="data_color[0][name]" id="username">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price_color_var">Giá biến thể</label>
                                    <input type="number" class="form-control" id="price_color_var" name="data_color[0][price]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="qty_color_var">Số lượng</label>
                                    <input type="number" class="form-control" id="qty_color_var" name="data_color[0][qty]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="color_var">Màu</label>
                                    <input type="color" class="form-control" id="color_var" name="data_color[0][color]">
                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                    </div>
                    <?php echo form_error('data_color') ?>

                    <label class="font-weight-bold h4">Biến thể Ram</label>
                    <a href="javascript:void(0)" class="btn btn-sm  btn-primary" onclick="create1()">Add</a>
                    <div id="ram">
                        <div id="item-ram" class="form-row justify-content-center align-items-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_ram_var">Tên thuộc tính ram</label>
                                    <input type="text" class="form-control" id="name_ram_var" name="data_ram[0][name]" id="username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price_ram_var">Giá biến thể</label>
                                    <input type="number" class="form-control" id="price_ram_var" name="data_ram[0][price]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="qty_ram_var">Số lượng</label>
                                    <input type="number" class="form-control" id="qty_ram_var" name="data_ram[0][qty]">
                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                    </div>
                    <?php echo form_error('data_ram') ?>
                    <label class="font-weight-bold">Danh mục sản phẩm</label>
                    <select name="parent_id" class="form-inline form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($list_category as $item) : ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['title'] ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <?php echo form_error('parent_id') ?>
                    <label class="font-weight-bold">Trạng thái</label>
                    <select name="status" class="form-inline form-control">
                        <option value="0">-- Chọn danh mục --</option>
                        <option value="Chờ xét duyệt">Chờ xét duyệt</option>
                        <option value="Đã đăng">Đã đăng</option>
                    </select><br>
                    <?php echo form_error('status') ?>
                    <button name="add_product" class="btn btn-primary btn-lg mt-4">Thêm mới</button><br>
                    <?php echo form_error('account') ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>