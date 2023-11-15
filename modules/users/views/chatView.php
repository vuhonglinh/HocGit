<?php
get_header();
?>
<div id="content" class="my-3">
    <div class="container">
        <div class="row m-auto">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div id="chat-box">
                    <div id="chat-header">
                        <div class="float-left">
                            <img class="img-fluid rounded-circle" src="img/Group 43.png" alt="">
                            <span class="font-weight-bold">Nhân viên cửa hàng</span>
                        </div>
                    </div>
                    <div class="chat-content">
                        <?php if (!empty($list_chat)) :
                            foreach ($list_chat as $item) :
                        ?>
                                <?php if ($item['status'] == 0) : ?>
                                    <div class="float-right chat-content-item-right">
                                        <p><?php echo $item['message'] ?></p>
                                        <span class="text-muted small"><?php echo $item['created_at'] ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($item['status'] == 1) : ?>
                                    <div class="float-left chat-content-item-left">
                                        <p><?php echo $item['message'] ?></p>
                                        <span class="text-muted small"><?php echo $item['created_at'] ?></span>
                                    </div>
                                <?php endif; ?>

                        <?php
                            endforeach;
                        endif; ?>
                    </div>
                    <form action="#" class="typing-area">
                        <input type="text" name="message" id="message" class="form-control" placeholder="Nhập nội dung ở đây..." autocomplete="off">
                        <button id="btn-chat" class="btn btn-info border-0"><img src="img/send.png" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>