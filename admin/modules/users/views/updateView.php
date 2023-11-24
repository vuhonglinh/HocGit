<?php
get_header();
?>
<div id="content">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-2 border-right">
                <?php get_sidebar(); ?>
            </div>
            <div class="col-md-10">
                <h6>THÔNG TIN TÀI KHOẢN</h6>
                <form method="POST" class="form-group ">
                    <label for="fullname">Tên hiển thị</label>
                    <input type="text" name="fullname" id="fullname" class="form-inline form-control" value="<?php echo $info_user['fullname'] ?>">
                    <?php echo form_error('fullname') ?>

                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" disabled id="username" class="form-inline form-control" value="<?php echo $info_user['username'] ?>">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-inline form-control" value="<?php echo $info_user['email'] ?>">
                    <?php echo form_error('email') ?>

                    <label for="tel">Số điện thoại</label>
                    <input type="tel" name="tel" id="tel" class="form-inline form-control" value="<?php echo $info_user['phone_number'] ?>">
                    <?php echo form_error('tel') ?>

                    <label for="address">Địa chỉ</label>
                    <textarea name="address" id="address" class="form-inline form-control"><?php echo $info_user['address'] ?></textarea>
                    <?php echo form_error('address') ?>

                    <button type="submit" name="btn-update" id="btn-submit" class="btn btn-primary btn-lg mt-3">Cập nhật</button>
                    <?php echo form_error('account') ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End content  -->
<?php
get_footer();
?>