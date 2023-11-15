<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">THÔNG TIN TRANG WEBSITE</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" class="form-group">
                    <label for="title">Tên website</label>
                    <input class="form-control form-inline" type="text" name="title" id="title" value="<?php echo $website['title'] ?>"><br>
                    <?php echo form_error("title") ?>
                    <label for="file">Logo</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="public/img/<?php echo $website['logo'] ?>" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error("file") ?>
                    <label for="introduce">Giới thiệu ngắn</label>
                    <textarea name="introduce" id="introduce" class="ckeditor form-control form-inline"><?php echo $website['introduce'] ?></textarea><br>
                    <?php echo form_error("introduce") ?>
                    <label for="address">Địa chỉ cửa hàng</label>
                    <input class="form-control form-inline" type="text" name="address" id="address" value="<?php echo $website['address'] ?>"><br>
                    <?php echo form_error("address") ?>
                    <label for="phone">Số điện thoại</label>
                    <input class="form-control form-inline" type="text" name="phone" id="phone" value="<?php echo $website['phone'] ?>"><br>
                    <?php echo form_error("phone") ?>
                    <label for="email">Email</label>
                    <input class="form-control form-inline" type="text" name="email" id="email" value="<?php echo $website['email'] ?>"><br>
                    <?php echo form_error("email") ?>
                    <button class="btn btn-primary btn-lg my-4" type="submit" name="update_website" id="btn-submit">Sửa</button><br>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>