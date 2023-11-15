<html>

<head>
    <title>Trang đăng ký</title>
    <link rel="stylesheet" href="public/css/login.css">
    <base href="<?php echo base_url() ?>">
</head>

<body>
    <div class="signup">
        <h1 class="signup-heading">Đăng ký</h1>
        <form action="" method="post">
            <label for="fullname" class="signup-label">Họ và tên</label>
            <input type="text" class="signup-input" name="fullname" id="fullname" placeholder="Eg: Nguyễn Văn A" value="<?php echo set_value('fullname') ?>">
            <span class="form-error"><?php echo (!empty($error['fullname'])) ? $error['fullname'] : false ?></span><br>

            <label for="email" class="signup-label">Email</label>
            <input type="email" class="signup-input" name="email" id="email" placeholder="Eg: nguyevana@gmail.com" value="<?php echo set_value('email') ?>">
            <span class="form-error"><?php echo (!empty($error['email'])) ? $error['email'] : false ?></span><br>

            <label for="username" class="signup-label">Tên đăng nhập</label>
            <input type="text" class="signup-input" name="username" id="username" placeholder="Eg: nguyenvana123" value="<?php echo set_value('username') ?>">
            <span class="form-error"><?php echo (!empty($error['username'])) ? $error['username'] : false ?></span><br>

            <label for="password" class="signup-label">Mật khẩu</label>
            <input type="password" class="signup-input" name="password" id="password">
            <span class="form-error"><?php echo (!empty($error['password'])) ? $error['password'] : false ?></span><br>

            <label for="address" class="signup-label">Địa chỉ</label>
            <input type="text" class="signup-input" name="address" id="address" placeholder="Eg: Hà Nội..." value="<?php echo set_value('address') ?>">
            <span class="form-error"><?php echo (!empty($error['address'])) ? $error['address'] : false ?></span><br>

            <label for="phone_number" class="signup-label">Số điện thoại</label>
            <input type="text" class="signup-input" name="phone_number" id="phone_number" placeholder="Độ dài 10 số..." value="<?php echo set_value('phone_number') ?>">
            <span class="form-error"><?php echo (!empty($error['phone_number'])) ? $error['phone_number'] : false ?></span><br>

            <button type="submit" class="signup-submit" name="btn-register">Đăng ký</button>
            <span class="form-error-submit"><?php echo (!empty($error['account'])) ? $error['account'] : false ?></span><br>
            <p class="signup-already">
                <span>Bạn muốn đăng nhập</span>
                <a href="?mod=log&controller=index&action=login" class="signup-login-link">Đăng nhập</a>
            </p>
        </form>
    </div>
</body>

</html>