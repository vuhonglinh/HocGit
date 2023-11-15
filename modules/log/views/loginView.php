<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="public/css/login.css">
    <base href="<?php echo base_url() ?>">

</head>

<body>
    <div class="signup">
        <h1 class="signup-heading">Đăng nhập</h1>
        <button class="signup-social">
            <i class="fa fa-google signup-social-icon"><img src="img/search.png" alt=""></i>
            <span class="signup-social-text">Sign up with Google</span>
        </button>
        <div class="signup-or"><span>or</span></div>
        <form action="" method="post">
            <label for="username" class="signup-label">Tên đăng nhập</label>
            <input type="text" class="signup-input" name="username" id="username" placeholder="Eg: NguyenVanA123" value="<?php if (isset($_COOKIE['me'])) {
                                                                                                                echo $_COOKIE['me'];
                                                                                                            } else {
                                                                                                                if (!empty($_POST['username'])) {
                                                                                                                    echo $_POST['username'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                }
                                                                                                            } ?>">
            <span class="form-error"><?php echo (!empty($error['username'])) ? $error['username'] : false ?></span><br>
            <label for="password" class="signup-label">Mật khẩu</label>
            <input type="password" class="signup-input" name="password" id="password" placeholder="Eg: nguyenvana@gmail.com">
            <span class="form-error"><?php echo (!empty($error['password'])) ? $error['password'] : false ?></span><br>
            <input type="checkbox" class="signup-checkbox" name="remenber_me" id="" <?php echo (isset($_COOKIE['me'])) ? ((isset($_COOKIE['me'])) ? "checked" : "") : ""; ?>><span class="signup-checkbox-text">Ghi nhớ tài khoản</span>
            <button class="signup-submit" name="btn-login">Đăng nhập</button>
            <span class="form-error-submit"><?php echo (!empty($error['account'])) ? $error['account'] : false ?></span><br>
            <p class="signup-already">
                <span>Quên mật khẩu</span>
                <a href="?mod=log&controller=index&action=reset" class="signup-login-link">Tại đây</a>
            </p>
            <p class="signup-already">
                <span>Bạn chưa chó tài khoản?</span>
                <a href="?mod=log&controller=index&action=register" class="signup-login-link">Đăng ký</a>
            </p>
        </form>
    </div>
</body>

</html>