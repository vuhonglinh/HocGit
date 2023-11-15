<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">THÊM QUẢNG CÁO</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên quảng cáo</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo set_value("name") ?>">
                    </div>
                    <?php echo form_error("name") ?>

                    <div class="form-group">
                        <label for="link">Link</label>
                        <input class="form-control" type="v" name="link" id="link" value="<?php echo set_value("link") ?>">
                    </div>
                    <?php echo form_error("link") ?>

                    <label for="file">Hình ảnh</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="public/img/photo.png" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error("file") ?>

                    <button type="submit" name="add-ads" class="btn btn-primary">Thêm mới</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>