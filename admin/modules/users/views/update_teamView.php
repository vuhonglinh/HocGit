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

                            <p class="text-muted text-center">Quản trị viên</p>

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
                            <?php get_sidebar("admin") ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="col-sm-6">
                        <h1>Cập nhật</h1>
                    </div>
                    <div class="tab-pane active p-2 bg-white" id="settings">
                        <form method="POST" class="form-group ">
                            <label for="fullname">Tên hiển thị</label>
                            <input type="text" name="fullname" id="fullname" class="form-inline form-control" value="<?php echo $user['fullname'] ?>">
                            <?php echo form_error('fullname') ?>

                            <label for="username">Tên đăng nhập</label>
                            <input type="text" disabled name="username" id="username" class="form-inline form-control" value="<?php echo $user['username'] ?>">
                            <?php echo form_error('username') ?>

                            <label for="password">Mật khẩu(Đã mã hóa)</label>
                            <input type="text" disabled name="password" id="password" class="form-inline form-control" value="<?php echo $user['password'] ?>">
                            <?php echo form_error('password') ?>

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-inline form-control" value="<?php echo $user['email'] ?>">
                            <?php echo form_error('email') ?>

                            <label for="phone_number">Số điện thoại</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-inline form-control" value="<?php echo $user['phone_number'] ?>">
                            <?php echo form_error('phone_number') ?>

                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address" class="form-inline form-control"><?php echo $user['address'] ?></textarea>
                            <?php echo form_error('address') ?>

                            <button type="submit" name="update_user" id="btn-submit" class="btn btn-primary btn-lg mt-3">Cập nhật</button>
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