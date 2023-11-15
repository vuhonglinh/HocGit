<?php 
$block = db_fetch_row("SELECT * FROM `tb_settings`");
?>
<div id="footer" class="mt-5 bg-white pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-3">
                <div class="">
                    <h3 class="text-danger"><?php echo $block['title'] ?></h3>
                    <?php echo $block['introduce'] ?>
                    <div id="payment">
                        <div class="thumb">
                            <img src="img/img-foot.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="block menu-ft" id="info-shop">
                    <h5 class="title">Thông tin cửa hàng</h5>
                    <ul class="list-item list-unstyled">
                        <li>
                            <p><img class="img-fluid img-thumbnail border-0" src="img/placeholder.png" alt=""><?php echo $block['address'] ?></p>
                        </li>
                        <li>
                            <p><img class="img-fluid img-thumbnai border-0" src="img/phone-call.png" alt=""><?php echo $block['phone'] ?></p>
                        </li>
                        <li>
                            <p><img class="img-fluid img-thumbnail border-0" src="img/email.png" alt=""><?php echo $block['email'] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="block menu-ft policy" id="info-shop">
                    <h5 class="title">Chính sách mua hàng</h5>
                    <ul class="list-item">
                        <li>
                            <a class="text-decoration-none" href="" title="">Quy định - chính sách</a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="" title="">Chính sách bảo hành - đổi trả</a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="" title="">Chính sách hội viện</a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="" title="">Giao hàng - lắp đặt</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="block" id="newfeed">
                    <h5 class="title">Bảng tin</h5>
                    <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                    <div id="form-reg">
                        <form method="POST" action="">
                            <input class="form-control" type="email" name="email" id="email" placeholder="Nhập email tại đây">
                            <button class="btn btn-primary mt-3" type="submit" id="sm-reg">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End footer  -->
<div class="container-fluid bg-primary">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <p class="text-light mt-3">© Bản quyền thuộc về Autosmart</p>
            </div>
        </div>
    </div>
</div>
</div>

<script src="public/js/code.jquery.com_jquery-3.3.1.slim.min.js"></script>
<script src="public/js/cdn.jsdelivr.net_npm_bootstrap@4.6.2_dist_js_bootstrap.bundle.min.js"></script>
<script src="public/js/cdn.jsdelivr.net_npm_jquery@3.5.1_dist_jquery.slim.min.js"></script>
<script src="public/js/code.jquery.com_jquery-3.7.1.min.js"></script>
<script src="public/js/code.jquery.com_jquery-3.7.0.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<script src="public/js/index.js" text="type/javascript"></script>
<script src="public/js/app.js" text="type/javascript"></script>
</body>

</html>