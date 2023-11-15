function insert_detail_img() {//Thêm ảnh chi tiết ở Update sản phẩm
    $("#insert-img").html("<label class='font-weight-bold'>Thêm ảnh chi tiết</label>" +
        "<div id='uploadFile'>" +
        "<div class='d-flex'>" +
        "<input type='file' name='images[]' multiple='multiple' onchange='uploadImageDetail(event)' class='form-control-file'>" +
        "<div id='detail_images' class='d-flex'>" +
        "<img id='size-img-thumb' src='public/img/photo.png' alt=''>" +
        "</div>" +
        "</div>" +
        "</div><br>");
}

function remove_(_this) {//Xóa ảnh chi tiết ở Update sản phẩm
    $(_this).closest('#uploadFileUpdate').remove();
}

function uploadImageDetail(event) { //Thêm ảnh chi tiết sản phẩm
    var inputFile = new FormData($("#imageUploadDetail")[0]);
    $.ajax({
        url: '?mod=product&action=ajaxUploadImage',
        method: 'POST',
        data: inputFile,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            if (data.status == "error") {
                $("#detail_images").html("<p class='text-danger'>Ảnh không đúng định dạng");
                return true;
            }
            // console.log(data);
            var array = Object.entries(data.result)
            var string = "";
            array.forEach(element => {
                string += " <img id='size-img-thumb' src='img/" + element[1] + "' alt=''>";
            });
            $("#detail_images").html(string);
        }
    })
}
function create1() {
    let count = document.querySelectorAll('#item-ram').length - 1;
    console.log(count);
    count++;
    $('#ram').append("<div id='item-ram' class='form-row justify-content-center align-items-center'>" +
        "<div class='col-md-4'>" +
        "<div class='form-group'>" +
        "<label for='name_ram_var'>Tên thuộc tính ram</label>" +
        "<input type='text' class='form-control' id='name_ram_var' name='data_ram[" + count + "][name]' id='username'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-4'>" +
        "<div class='form-group'>" +
        "<label for='price_ram_var'>Gía</label>" +
        "<input type='number' class='form-control' id='price_ram_var' name='data_ram[" + count + "][price]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-3'>" +
        "<div class='form-group'>" +
        "<label for='qty_ram_var'>Số lượng</label>" +
        "<input type='number' class='form-control' id='qty_ram_var' name='data_ram[" + count + "][qty]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-1'>" +
        " <a href='javascript:void(0)' class='btn btn-danger' onclick='delete1_(this)'>Xóa</a>" +
        "</div>" +
        "</div>");
}

function delete1_(_this) {
    var color = document.querySelectorAll('#ram').length - 1;
    $(_this).closest('#item-ram').remove();
}

function create() {
    let count = document.querySelectorAll('#item-color').length - 1;
    console.log(count);
    count++;
    $('#color').append("<div id='item-color' class='form-row justify-content-center align-items-center'>" +
        "<div class='col-md-3'>" +
        "<div class='form-group'>" +
        "<label for=''>Tên thuộc tính màu sắc</label>" +
        "<input type='text' class='form-control' id='name_color_var' name='data_color[" + count + "][name]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-3'>" +
        "<div class='form-group'>" +
        "<label for='password'>Gía</label>" +
        " <input type='number' class='form-control' id='price_color_var' name='data_color[" + count + "][price]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-3'>" +
        "<div class='form-group'>" +
        "<label for='qty_color_var'>Số lượng</label>" +
        "<input type='number' class='form-control' id='qty_color_var' name='data_color[" + count + "][qty]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-2'>" +
        "<div class='form-group'>" +
        "<label for='password'>Màu</label>" +
        "<input type='color' class='form-control' id='color_var' name='data_color[" + count + "][color]'>" +
        "</div>" +
        "</div>" +
        "<div class='col-md-1'>" +
        " <a href='javascript:void(0)' class='btn btn-danger' onclick='delete_(this)'>Xóa</a>" +
        "</div>" +
        "</div>");
}


function delete_(_this) {
    var color = document.querySelectorAll('#color').length - 1;
    $(_this).closest('#item-color').remove();
}


function uploadImage(event) {
    var inputFile = event.target.files[0];
    var number = event.currentTarget.getAttribute("number")
    var formData = new FormData();
    formData.append('file', inputFile);
    formData.append('number', number);
    $.ajax({
        url: '?mod=product&action=ajax',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            var id = "#img-thumb-" + data.number;
            if (data.status == 'error') {
                $(id).html("<p id='text-img-thumb' class='text-danger'>Lỗi tải ảnh</p>")
            } else {
                $(id).html("<img  id='size-img-thumb' src='" + data.targetFile + "' class='img-fluid img-thumbnail' alt=''>")
            }
        }
    })
}


