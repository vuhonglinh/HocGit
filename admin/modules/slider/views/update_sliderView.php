<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA SLIDER</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="slug">Link</label>
                        <input class="form-control" type="text" name="slug" id="slug" value="<?php echo $slider["link"]; ?>">
                    </div>
                    <?php echo form_error("slug") ?>

                    <div class="form-group">
                        <label for="slider_order">Thứ tự</label>
                        <input class="form-control" type="slider_order" name="slider_order" id="slider_order" value="<?php echo $slider["number_order"]; ?>">
                    </div>
                    <?php echo form_error("slider_order") ?>

                    <label for="file">Hình ảnh</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="img/<?php echo $slider['slider_img'] ?>" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error("file") ?>

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="Đã đăng" <?php if ($slider['status'] == "Đã đăng") echo "selected"; ?>>Đã đăng</option>
                            <option value="Chờ xét duyệt" <?php if ($slider['status'] == "Chờ xét duyệt") echo "selected"; ?>>Chờ xét duyệt</option>
                        </select>
                    </div>
                    <?php echo form_error("status") ?>

                    <button type="submit" name="update-slider" class="btn btn-primary">Cập nhật</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>