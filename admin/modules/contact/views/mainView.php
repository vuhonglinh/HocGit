<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="col-sm-6">
            <h1>Hộp thư đến</h1>
        </div>
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search Mail">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái hoạt động</th>
                                <th>Chi tiết</th>
                            </tr>
                            <tbody id="status">
                                <?php
                                foreach ($list_customers as $item) :
                                ?>
                                    <tr>
                                        <td class="mailbox-star"><?php echo $item['fullname'] ?></td>
                                        <td class="mailbox-star"><?php echo $item['email'] ?></td>
                                        <td class="mailbox-star"><?php echo $item['phone_number'] ?></td>
                                        <td class="mailbox-star"><?php echo $item['address'] ?></td>
                                        <td class="mailbox-date"><?php echo ($item['status'] == 1) ? "<p class='text-success'>Đăng hoạt động</p>" : "<p class='text-danger'>Không hoạt động</p>" ?></td>
                                        <td class="mailbox-date">
                                            <a href="?mod=contact&action=detail&id=<?php echo $item['id'] ?>">
                                                <img src="public/img/messenger.png" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
</div>
<script>
    function kiemTraTrangThaiHoatDong() {
        $.ajax({
            url: '?mod=contact&action=ajax',
            method: 'POST',
            dataType: 'html',
            success: function(data) {
                $("#status").html(data);
            }
        });
    }
    setInterval(kiemTraTrangThaiHoatDong, 3000);
</script>
<?php
get_footer();
?>