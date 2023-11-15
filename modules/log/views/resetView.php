<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="public/css/login.css">
    <base href="<?php echo base_url() ?>">
</head>

<body>
    <div class="signup">
        <h1 class="signup-heading">Khôi phục mật khẩu</h1>
        <form action="" method="post">
            <label for="email" class="signup-label">Email</label>
            <input type="text" class="signup-input" name="email" id="email" placeholder="Eg: nguyenvan@gmail.com">
            <span class="form-error"><?php echo (!empty($error['email'])) ? $error['email'] : false ?></span><br>

            <button type="submit" class="signup-submit" name="btn-reset">Gửi yêu cầu</button>
            <span class="form-error-submit"><?php echo (!empty($error['account'])) ? $error['account'] : false ?></span><br>
            <p class="signup-already">
                <span>Đằng nhập tại đầy</span>
                <a href="?mod=log&controller=index&action=login" class="signup-login-link">Đăng nhập</a>
            </p>
            <p class="signup-already">
                <span>Bạn chưa chó tài khoản?</span>
                <a href="?mod=log&controller=index&action=register" class="signup-login-link">Đăng ký</a>
            </p>
        </form>
    </div>
</body>

</html>