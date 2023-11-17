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
                    <table class="table table-striped">
                        <thead>
                            <tr class="thead-dark">
                                <th>STT</th>
                                <th>Họ và tên</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th colspan="2">Phòng ban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list_users)) :
                                $count = 0;
                                foreach ($list_users as $item) :
                                    $count++; ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $item['fullname']; ?></td>
                                        <td><?php echo $item['username']; ?></td>
                                        <td><?php echo $item['email']; ?></td>
                                        <td><?php echo $item['phone_number']; ?></td>
                                        <td><?php echo $item['role_name']; ?></td>
                                        <td>
                                            <a href="?mod=users&controller=team&action=update&id=<?php echo $item['user_id'] ?>" title="Sửa"><img src="public/img/pen (1).png" alt=""></a>
                                            <a onclick="return confirm('Bạn chắc muốn xóa sản không')" class="ml-4" href="?mod=users&controller=team&action=delete&id=<?php echo $item['user_id'] ?>" title="Xóa"><img src="public/img/delete1.png" alt=""></a>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                        <?php global $num_rows;
                        echo get_padding($num_rows); ?>
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

