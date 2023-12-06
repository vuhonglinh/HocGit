<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 class="page-title">ĐĂNG NHẬP</h1>
        <form action="" id="form-login" method="post">
            <div class="login-field">
                <img id="login-icon" src="public/img/user.png" alt="">
                <input type="text" name="username" id="username" placeholder="Tên đăng nhập..." value="<?php if (isset($_COOKIE['me'])) {
                                                                                                            echo $_COOKIE['me'];
                                                                                                        } else {
                                                                                                            if (!empty($_POST['username'])) {
                                                                                                                echo $_POST['username'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            }
                                                                                                        }
                                                                                                        ?>">
            </div>
            <?php echo form_error('username') ?>
            <div class="login-field">
                <img id="login-icon" src="public/img/padlock.png" alt="">
                <input type="password" name="password" id="password" placeholder="Mật khẩu...">
            </div>
            <?php echo form_error('password') ?>
            <input type="checkbox" name="remenber_me" id="" <?php echo (isset($_COOKIE['me'])) ? ((isset($_COOKIE['me'])) ? "checked" : "") : ""; ?>>Ghi nhớ tài khoản
            <input type="submit" name="btn-login" id="btn-login" value="ĐĂNG NHẬP">
            <span id="span"><?php echo form_error('account') ?></span>
        </form>
    </div>
</body>

</html>