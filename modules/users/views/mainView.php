<?php
get_header();
?>
<a href="?mod=users&action=chat">Chat</a>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-3 border-right">
            <div class="">
                <div class="text-center my-3">
                    <img id="img_user_info" class="img-fluid img-thumbnail rounded-circle" src="<?php echo !empty($users['img']) ? "admin/img/{$users['img']}" : "img/avata.png"; ?>" alt="">
                    <h6 class="my-3"><?php echo info_login() ?></h6>
                </div>

            </div>
            <div>
                <div class="list-group">
                    <a href="#tab-1" class="list-group-item list-group-item-action active border-0" data-toggle="list">Thông tin cá nhân</a>
                    <a href="#tab-2" class="list-group-item list-group-item-action border-0" data-toggle="list">Lịch sử mua hàng</a>
                    <a href="#tab-3" class="list-group-item list-group-item-action border-0" data-toggle="list">Đổi mật khẩu</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active fade show" id="tab-1">
                    <h3>Thông tin cơ bản</h3>
                    <form action="" enctype="multipart/form-data" method="post" class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control form-inline" name="fullname" id="fullname" value="<?php echo $users['fullname'] ?>"><br>
                        <?php echo form_error("fullname") ?>

                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control form-inline" name="address" id="address" value="<?php echo $users['address'] ?>"><br>
                        <?php echo form_error("address") ?>

                        <label for="phone_number">Số điện thoại</label>
                        <input type="text" class="form-control form-inline" name="phone_number" id="phone_number" value="<?php echo $users['phone_number'] ?>"><br>
                        <?php echo form_error("phone_number") ?>

                        <label for="email">Email</label>
                        <input type="text" class="form-control form-inline" name="email" id="email" value="<?php echo $users['email'] ?>"><br>
                        <?php echo form_error("email") ?>

                        <div id="uploadFile">
                            <div class="d-flex">
                                <input type="file" name="file" number="1" id="upload-thumb" onchange="uploadImage(event)" class="form-control-file">
                                <div id="img-thumb-1">
                                    <img id="size-img-thumb" src="img/photo.png" alt="">
                                </div>
                            </div>
                            <!-- <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb" class="btn btn-primary"> -->
                        </div><br>
                        <?php echo form_error("file") ?>
                        <input type="submit" class="btn btn-primary btn-sm my-4" name="update_info" value="Cập nhật lại"><br>
                        <?php echo form_error("account") ?>
                    </form>
                </div>
                <div class="tab-pane fade show" id="tab-2">
                    <h3>Lịch sử đặt hàng</h3>
                    <?php foreach ($list_order as $item) :
                        $total = 0; ?>
                        <div class="row  bg-secondary text-light">
                            <div class="col-md-12">
                                <div>
                                    <p class="float-left"><img src="img/bar-code.png" alt=""><?php echo $item['order_code'] ?></p>
                                    <p class="float-right"><img src="img/oclock.png" alt=""><?php echo $item['time'] ?></p>
                                </div>
                            </div>
                            <?php
                            $data = json_decode($item['order_buy'], true);
                            foreach ($data as $item) :
                                $total += $item['sub_total'];
                            ?>
                                <div class="col-md-12">
                                    <div class="row my-2">
                                        <div class="col-md-1">
                                            <img src="admin/img/<?php echo $item['product_thumb'] ?>" class="" width="50px" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            <h6><?php echo $item['product_name'] ?></h6>
                                            <p>X <?php echo $item['qty'] ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Thành tiền: <span><?php echo currency_format($item['sub_total']) ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row bg-secondary text-light mb-3">
                            <div class="col-md-12">
                                <h5>Tông tiền thanh toán: <span><?php echo currency_format($total) ?></span></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="tab-pane fade show" id="tab-3">
                    <h3>Đổi mật khẩu</h3>
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
        </div>
    </div>
</div>
<?php
get_footer();
?>