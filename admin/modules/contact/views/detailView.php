<?php
get_header();
// get_sidebar();
?>
<div class="content-wrapper">
    <section class="content">
        <div class="col-sm-6">
            <h4>Trò chuyện trực tiếp</h4>
        </div>
        <div class="col-md-12">
            <div class="card direct-chat direct-chat-primary" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">Direct Chat</h3>
                    <div class="card-tools">
                        <span title="3 New Messages" class="badge badge-primary">3</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="direct-chat-messages">
                        <?php if (!empty($list_chat)) :
                            foreach ($list_chat as $item) :
                        ?>
                                <?php
                                if ($item['status'] == 0) :
                                ?>
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left"><?php echo $item['fullname'] ?></span>
                                            <span class="direct-chat-timestamp float-right"><?php echo $item['time'] ?></span>
                                        </div>

                                        <img class="direct-chat-img" src="img/<?php echo $item['img'] ?>" alt="message user image">

                                        <div class="direct-chat-text">
                                            <?php echo $item['message'] ?>
                                        </div>

                                    </div>
                                <?php endif ?>

                                <?php if ($item['status'] == 1) : ?>
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Quản trị viên</span>
                                            <span class="direct-chat-timestamp float-left"><?php echo $item['time'] ?></span>
                                        </div>

                                        <img class="direct-chat-img" src="public/img/Group 43.png" alt="message user image">

                                        <div class="direct-chat-text">
                                            <?php echo $item['message'] ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                        <?php
                            endforeach;
                        endif; ?>
                    </div>

                    <div class="card-footer">
                        <form action="">
                            <div class="input-group">
                                <input type="text" id="message" customer_id="<?php echo $_GET['id'] ?>" placeholder="Nội dung tin nhắn ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" id="btn-chat" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
    </section>
</div>
<script>
    function scrollChatToBottom() { //Cho thanh croll luôn ở dưới cùng
        var chatBox = document.querySelector('.direct-chat-messages');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollChatToBottom()
    $(document).ready(function() {
        $("#btn-chat").click(function(e) {
            e.preventDefault();
            var message = $("#message").val();
            var customer_id = $("#message").attr("customer_id");
            var data = {
                customer_id: customer_id,
                message: message
            };
            $.ajax({
                url: '?mod=contact&action=chatAjax',
                method: 'POST',
                data: data,
                dataType: 'html',
                success: function(data) {
                    $(".direct-chat-messages").html(data);
                    scrollChatToBottom()
                    $('#message').val("");
                }
            })
        });
    });

    function reaload() {
        var customer_id = $("#message").attr("customer_id");
        var data = {
            customer_id: customer_id,
        }
        $.ajax({
            url: '?mod=contact&action=chatAjax',
            method: 'POST',
            data: data,
            dataType: 'html',
            success: function(data) {
                $(".direct-chat-messages").html(data);
                scrollChatToBottom()
            }
        })
        
    }
    setInterval(reaload, 1000);
</script>
<?php
get_footer();
?>