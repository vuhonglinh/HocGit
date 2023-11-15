<html>

<head>
    <title>Khôi phục mật khẩu</title>
    <link rel="stylesheet" href="public/css/login.css">
    <base href="<?php echo base_url() ?>">
</head>

<body>
    <div class="signup">
        <h1 class="signup-heading">Đổi mật khẩu</h1>
        <form action="" method="post">
            <label for="password" class="signup-label">Mật khẩu</label>
            <input type="text" class="signup-input" name="password" id="password" placeholder="Vui lòng nhập mật khẩu mới...">
            <span class="form-error"><?php echo (!empty($error['password'])) ? $error['password'] : false ?></span><br>

            <button class="signup-submit" name="btn-new-pass">Lưu</button>
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