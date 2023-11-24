function add_cart(event) {
    event.preventDefault();
    var product_id = $("#ram").attr("product_id");
    var id_ram = $("#ram").val();
    var id_color = $("input[name='color']:checked").val();
    var quantity = $("#num-order").val();

    if (id_color == null) {
        Swal.fire({
            icon: 'error',
            title: 'Chú ý',
            text: 'Vui lòng chọn đầy đủ thông tin của sản phẩm trước khi đặt mua!',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }

    var data = {
        product_id: product_id,
        id_color: id_color,
        id_ram: id_ram,
        quantity: quantity,
    };

    $.ajax({
        url: '?mod=cart&action=add_cart',
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {

            // Cập nhật giao diện người dùng sau khi thêm vào giỏ hàng
            $("#menu_total_cart").html(response.total_cart);
            $("#menu_total_cart_sm").html(response.total_cart);
            $("#total_price_cart").html(response.total);
            $("#list_add_cart").html(response.list_add_cart);
            $("#quantity_product").html("<span>Trong kho</span>");
            $("#status").html("");
            // Gọi hàm cập nhật UI và chuyển response vào
            updateUI(response);
        },
        error: function (error) {
            console.log('Error:', error);
        }
    });
}

function updateUI(response) {
    // Sau khi thêm vào giỏ hàng
    Swal.fire({
        icon: 'success',
        title: 'Đã thêm vào giỏ hàng!',
        text: 'Sản phẩm đã được thêm vào giỏ hàng của bạn.',
        showConfirmButton: false, // Không hiển thị nút xác nhận
        timer: 1000 // Tự động đóng sau 2 giây
    });
    selectVar();
    selectColorVar(_this);
}



function selectColorVar(_this) {
    var color_id = $(_this).val();
    var data = {
        color_id: color_id,
    }
    $.ajax({
        url: '?mod=product&action=detail_color_ajax',
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $("#product_name").html(data.product_name);
            $("#quantity_product").html(`<span>Còn ` + data.quantity + ` sản phẩm</span>`);
            $("#product_price").html(data.price);
            $("#status").html(
                `<input type="number" name="num-order" id="num-order" min="1" max="` + data.quantity + `" value="1" id="num-order">`);
        }
    })
}

function selectVar() {
    var product_id = $("#ram").attr("product_id");
    var ram = $("#ram").val();
    var data = {
        product_id: product_id,
        ram: ram,
    }
    $.ajax({
        url: '?mod=product&action=detail_ajax',
        method: 'POST',
        data: data,
        dataType: 'html',
        success: function (data) {
            $("#color_var").html(data);
        }
    })
}
selectVar();

function add_comment(event) {//Thêm bình luận
    event.preventDefault();
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
            console.log(data);
            var result = "";
            data.forEach(element => {
                if (element.img == "") {
                    img_user = "img/user.png";
                } else {
                    img_user = "admin/img/" + element.img;
                }
                var img = "";
                for (let i = 1; i <= element.star; i++) {
                    img += "<span><i class='fa-solid fa-star'></i></span>";
                }
                string = "<div class='tp-product-details-review-avater d-flex align-items-start'>" +
                    "<div class='tp-product-details-review-avater-thumb'>" +
                    "<a href='#'>" +
                    "<img src='" + img_user + "' alt=''>" +
                    "</a>" +
                    "</div>" +
                    "<div class='tp-product-details-review-avater-content'>" +
                    "<div class='tp-product-details-review-avater-rating d-flex align-items-center'>" +
                    " " + img + " " +
                    "</div>" +
                    "<h3 class='tp-product-details-review-avater-title'>" + element.fullname + "</h3>" +
                    "<span class='tp-product-details-review-avater-meta'>" + element.time + "</span>" +

                    "<div class='tp-product-details-review-avater-comment'>" +
                    "<p>" + element.comment_content + "</p>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
                result += string
            });
            $('#list_comment').html(result);
            $("#comment").val("");
            $("input[name='star']").prop("checked", false)
        }
    })
}


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