<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA SẢN PHẨM</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data" id="imageUploadDetail" class="form-group">
                    <label for="product-name">Tên sản phẩm</label>
                    <input type="text" name="product_name" id="product-name" class="form-inline form-control" value="<?php echo $product['product_name'] ?>"><br>
                    <?php echo form_error('product_name') ?>
                    <label for="product-code">Mã sản phẩm</label>
                    <input type="text" name="product_code" id="product-code" class="form-inline form-control" value="<?php echo $product['product_code'] ?>"><br>
                    <?php echo form_error('product_code') ?>
                    <label for="price">Giá cơ bản</label>
                    <input type="text" name="price" id="price" class="form-inline form-control" value="<?php echo $product['price'] ?>"><br>
                    <?php echo form_error('price') ?>
                    <label for="desc">Mô tả ngắn</label>
                    <textarea name="product_desc" id="desc" class="ckeditor"><?php echo $product['product_desc'] ?></textarea><br>
                    <?php echo form_error('product_desc') ?>
                    <label for="desc">Chi tiết</label>
                    <textarea name="product_content" id="desc" class="ckeditor"><?php echo $product['product_content'] ?></textarea><br>
                    <?php echo form_error('product_content') ?>
                    <label>Hình ảnh đại diện</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="image" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-image">
                                <img id="size-img-thumb" src="img/<?php echo $product['product_thumb'] ?>" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error('file') ?>

                    <label class="font-weight-bold h4">Danh sách ảnh chi tiết</label>
                    <div id="insert-img">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="insert_detail_img()">Add</a>
                    </div>
                    <div id="updateImgDeatil">
                        <?php $count = 0;
                        foreach ($img_detail as $item) :
                            $count++;
                        ?>
                            <div id="uploadFileUpdate">
                                <label>Hình ảnh chi tiết <?php echo $count ?></label>
                                <div id="uploadFile">
                                    <div class="d-flex">
                                        <input type="file" name="detail_img[<?php echo $item['id'] ?>]" number="<?php echo $count; ?>" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                                        <div id="img-thumb-<?php echo $count; ?>">
                                            <img id="size-img-thumb" src="img/<?php echo $item['image'] ?>" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" onclick="remove_(this)" class="btn btn-sm btn-danger m-4">Xóa</a>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        <?php endforeach;
                        ?>
                    </div>
                    <?php echo form_error('images') ?>
                    <label class="font-weight-bold h4">Biến thể màu sắc</label>
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="create()">Add</a>
                    <div id="color">
                        <?php
                        $count_color = 0;
                        foreach ($list_color_var as $item) :
                            $count_color++;
                        ?>
                            <div id="item-color" class="form-row justify-content-center align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name_color_var">Tên thuộc tính màu sắc</label>
                                        <input type="text" value="<?php echo $item['color_name'] ?>" class="form-control" id="name_color_var" name="available_color[<?php echo $item['id']; ?>][name]" id="username">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price_color_var">Gía biến thể</label>
                                        <input type="number" value="<?php echo $item['color_price'] ?>" class="form-control" id="price_color_var" name="available_color[<?php echo $item['id']; ?>][price]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qty_color_var">Số lượng</label>
                                        <input type="number" value="<?php echo $item['quantity'] ?>" class="form-control" id="qty_color_var" name="available_color[<?php echo $item['id']; ?>][qty]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="color_var">Màu</label>
                                        <input type="color" value="<?php echo $item['color'] ?>" class="form-control" id="color_var" name="available_color[<?php echo $item['id']; ?>][color]">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <?php if ($count_color > 1) : ?>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_(this)">Xóa</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php echo form_error('data_color') ?>
                    <label class="font-weight-bold h4">Biến thể Ram</label>
                    <a href="javascript:void(0)" class="btn btn-sm  btn-primary" onclick="create1()">Add</a>
                    <div id="ram">
                        <?php
                        $count_ram = 0;
                        foreach ($list_ram_var as $item) :
                            $count_ram++;
                        ?>
                            <div id="item-ram" class="form-row justify-content-center align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_ram_var">Tên thuộc tính ram</label>
                                        <input type="text" value="<?php echo $item['nemory_name'] ?>" class="form-control" id="name_ram_var" name="available_ram[<?php echo $item['id']; ?>][name]">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_ram_var">Gía biến thể</label>
                                        <input type="number" value="<?php echo $item['nemory_price'] ?>" class="form-control" id="price_ram_var" name="available_ram[<?php echo $item['id']; ?>][price]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qty_ram_var">Số lượng</label>
                                        <input type="number" value="<?php echo $item['quantity'] ?>" class="form-control" id="qty_ram_var" name="available_ram[<?php echo $item['id']; ?>][qty]">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <?php if ($count_ram > 1) : ?>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete1_(this)">Xóa</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php echo form_error('data_ram') ?>

                    <label>Danh mục sản phẩm</label>
                    <select name="parent_id" class="form-inline form-control">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($list_category as $item) : ?>
                            <option value="<?php echo $item['id'] ?>" <?php if ($product['cat_id'] == $item['id']) echo "selected" ?>><?php echo $item['title'] ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <?php echo form_error('parent_id') ?>

                    <label>Trạng thái</label>
                    <select name="status" class="form-inline form-control">
                        <option value="0">-- Chọn danh mục --</option>
                        <option value="Đã đăng" <?php if ($product['status'] == "Đã đăng") echo "selected" ?>>Đã đăng</option>
                        <option value="Chờ xét duyệt" <?php if ($product['status'] == "Chờ xét duyệt") echo "selected" ?>>Chờ xét duyệt</option>
                    </select><br>
                    <?php echo form_error('status') ?>
                    <button type="submit" name="update_product" id="btn-submit" class="btn btn-primary btn-lg mt-4">Sửa</button><br>
                    <?php echo form_error('account') ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>