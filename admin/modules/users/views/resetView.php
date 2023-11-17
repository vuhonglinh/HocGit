<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>HỒ SƠ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?mod=home&action=index">Home</a></li>
                        <li class="breadcrumb-item active">Hồ sơ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="public/img/admin.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo info_login() ?></h3>

                            <p class="text-muted text-center"><?php echo $info_user['role_name'] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tên đăng nhập</b> <a class="float-right"><?php echo info_login('username') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số điện thoại</b> <a class="float-right"><?php echo info_login('phone_number') ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?php echo info_login('email') ?></a>
                                </li>
                            </ul>
                            <?php
                            get_sidebar('admin');
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="col-sm-6">
                        <h1>Đổi mật khẩu</h1>
                    </div>
                    <div class="tab-pane active p-2 bg-white" id="settings">
                        <form method="POST" class="form-group ">
                            <label for="pass-old">Mật khẩu cũ</label>
                            <input type="password" name="pass-old" id="pass-old" class="form-inline form-control">
                            <?php echo form_error('pass-old') ?>


                            <label for="pass-new">Mật khẩu mới</label>
                            <input type="password" name="pass-new" id="pass-new" class="form-inline form-control">
                            <?php echo form_error('pass-new') ?>


                            <label for="confirm-pass">Nhập lại mật khẩu mới</label>
                            <input type="password" name="confirm-pass" id="confirm-pass" class="form-inline form-control">
                            <?php echo form_error('confirm-pass') ?>


                            <button type="submit" name="btn-change-pass" id="btn-submit" class="btn btn-primary btn-lg mt-3">Cập nhật</button>
                            <?php echo form_error('account') ?>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php
get_footer();
?>