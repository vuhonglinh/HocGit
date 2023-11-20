




function addCart(event) {//Thêm vào giỏ hàng
    var id = event.currentTarget.getAttribute("id_product");
    var data = { id: id };
    $("#comment").val("");
    $.ajax({
        url: '?mod=home&action=ajax',
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function (data) {
            $('#menu-total-cart').html(data.count)
            var array = Object.entries(data.list_add);
            var totalString = "";
            array.forEach(element => {
                var string = "<div class='media border-bottom'>" +
                    "<a href=''>" +
                    "<img src='admin/img/" + element[1].product_thumb + "' class='img-fluid img-thumbnail border-0 mr-3' style='height: 80px;' alt=''>" +
                    "</a>" +
                    "<div class='media-body'>" +
                    "<a class='text-decoration-none' id='mane-product' href=''>" + element[1].product_name + "</a>" +
                    "<div class='d-flex'>" +
                    "<p class='text-danger float-left' style='font-size: 12px;'>" + element[1].price + "</p>" +
                    "</div>" +
                    "</div>" +
                    "<p class='text-black-50'>Số lượng X " + element[1].qty + "</p>" +
                    "</div>";
                totalString += string;
            });
            $('#list_add_cart').html(totalString);
            alert("Đã thêm vào giỏ hàng")
        }
    })
}



$(document).ready(function () {//Thêm bình luận
    $('#add-comment').click(function (e) {
        e.preventDefault();
        var comment = $('#comment').val();
        if (comment == "") {
            return false;
        }
        var id_product = $('#comment').attr('id_product');
        var star = $("input[name='star']").filter(":checked").val()
        var formData = { comment: comment, id_product: id_product, star: star }
        $.ajax({
            url: '?mod=product&action=ajax',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (data) {
                var result = "";
                data.forEach(element => {
                    if (element.img == "") {
                        img_user = "img/user.png";
                    } else {
                        img_user = "admin/img/"+element.img;
                    }
                    var img = "";
                    for (let i = 1; i <= element.star; i++) {
                        img += "<img src='img/sao.png' alt=''>";
                    }
                    string = "<div id='item-comment'>" +
                        "<div id='header-comment'>" +
                        "<img id='img-user-comment' class='box rounded-circle' src='" + img_user + "' alt=''>" +
                        "<h6 class='mt-2 ml-1'>" + element.fullname + "</h6>" +
                        "</div>" +
                        "<div>" + img +
                        "</div>" +
                        "<div>" +
                        "<p>" + element.comment_content + "</p>" +
                        "</div>" +
                        "<div>" +
                        " <img src='img/oclock.png' alt=''><span class='text-black-50'>" + element.time + "</span>" +
                        "</div>" +
                        "</div>";
                    result += string;
                });
                $('#list_comment').html(result);
                $("#comment").val("");
                $("input[name='star']").prop("checked", false)
            }
        })
    });
});


function uploadImage(event) {
    var inputFile = event.target.files[0];
    var number = event.currentTarget.getAttribute("number")
    var formData = new FormData();
    formData.append('file', inputFile);
    formData.append('number', number);
    $.ajax({
        url: '?mod=users&action=ajax',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            var id = "#img-thumb-" + data.number;
            console.log(data);
            if (data.status == 'error') {
                $(id).html("<p id='text-img-thumb' class='text-danger'>Lỗi tải ảnh</p>")
            } else {
                $(id).html("<img  id='size-img-thumb' src='" + data.targetFile + "' class='img-fluid img-thumbnail' alt=''>")
            }
        }
    })
}

$(document).ready(function () {
    $('.share').click(function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0,         directories=0, scrollbars=0');
        return false;
    });
});

function scrollChatToBottom() {//Cho thanh croll luôn ở dưới cùng
    var chatBox = document.querySelector('.chat-content');
    chatBox.scrollTop = chatBox.scrollHeight;
}
scrollChatToBottom();
$(document).ready(function () {//Thêm bình luận
    $('#btn-chat').click(function (e) {
        e.preventDefault();
        var message = $('#message').val();
        if (message == "") {
            return false;
        }
        var data = { message: message };
        $.ajax({
            url: '?mod=users&action=chatAjax',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                var string = "";
                data.forEach(element => {
                    console.log(element.status);
                    if (element.status == 0) {
                        string += "<div class='float-right chat-content-item-right'>" +
                            "<p>" + element.message + "</p>" +
                            "<span class='text-muted small'>" + element.created_at + "</span>" +
                            "</div>";
                    } else {
                        string += "<div class='float-left chat-content-item-left'>" +
                            "<p>" + element.message + "</p>" +
                            "<span class='text-muted small'>" + element.created_at + "</span>" +
                            "</div>";
                    }

                });
                $(".chat-content").html(string);
                scrollChatToBottom();
                $('#message').val("");
            }
        })
    });
});