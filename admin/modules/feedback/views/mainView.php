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
                        <div class="float-left chat-content-item-left">
                            <span>Hello</span>
                        </div>
                                <div class="float-right chat-content-item-right">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos iure placeat ipsam vitae aperiam recusandae quae fuga tenetur odio excepturi.</p>
                                    <span class="text-muted small">20:30 23-03-2023</span>
                                </div>
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