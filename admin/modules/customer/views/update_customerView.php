<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA THÔNG TIN KHÁCH HÀNG</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" class="form-group">
                    <label for="fullname">Họ và tên</label>
                    <input type="text" name="fullname" id="fullname" class="form-inline form-control" value="<?php echo $customer['fullname'] ?>"><br>
                    <?php echo form_error("fullname") ?>
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-inline form-control" value="<?php echo $customer['username'] ?>"><br>
                    <?php echo form_error("username") ?>
                    <label for="password">Mật khẩu(Đã mã hóa)</label>
                    <input type="text" disabled name="password" id="password" class="form-inline form-control" value="<?php echo $customer['password'] ?>"><br>
                    <?php echo form_error("password") ?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-inline form-control" value="<?php echo $customer['email'] ?>"><br>
                    <?php echo form_error("email") ?>
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-inline form-control" value="<?php echo $customer['address'] ?>"><br>
                    <?php echo form_error("address") ?>
                    <label for="tel">Số điện thoại</label>
                    <input type="text" name="tel" id="tel" class="form-inline form-control" value="<?php echo $customer['phone_number'] ?>"><br>
                    <?php echo form_error("tel") ?>
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <div class="d-flex">
                            <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                            <div id="img-thumb-1">
                                <img id="size-img-thumb" src="<?php echo !empty($customer['img']) ? "img/" . $customer['img'] : "public/img/photo.png"; ?>" alt="">
                            </div>
                        </div>
                    </div><br>
                    <?php echo form_error("file") ?>
                    <label>Trạng thái</label>
                    <select name="is_active" class="form-inline form-control">
                        <option value="0" <?php if ($customer['is_active'] == 0) echo "selected" ?>>Chưa xác thực</option>
                        <option value="1" <?php if ($customer['is_active'] == 1) echo "selected" ?>>Đã xác thực</option>
                    </select><br>
                    <?php echo form_error("is_active") ?>
                    <button type="submit" name="update_customer" id="btn-submit" class="btn btn-primary mt-3">Thêm mới</button><br>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>