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
    console.log(inputFile);
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

var ramVariantCount = 0;
function addRamVariant() {//Thêm biến thể Ram
    ramVariantCount++;
    $('#ramVariants').append(`<div id="ram_` + ramVariantCount + `" class="border p-3 bg-info my-3">
    <div id="item-ram" class="form-row justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name_ram_var">Tên thuộc tính ram</label>
                <input type="text" class="form-control" id="name_ram_var" name="ram_variants[` + ramVariantCount + `][name]">
            </div>
        </div>
    </div>
    <a href="javascript:void(0)" class="btn btn-sm btn-danger float-right" onclick="removeRamVariant(` + ramVariantCount + `)">Xóa</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-primary"  onclick="addColorVariant(` + ramVariantCount + `)">Add màu sắc</a>
   <div class="colorVariants">

   </div>
</div>`);
}




function removeRamVariant(ramVariantId) {//Xóa biến thể Ram
    // Xóa biến thể Ram theo ID
    $('#ram_' + ramVariantId).remove();
}

function addColorVariant(ramVariantId) {//Thêm biến thể màu sắc
    var colorVariantsContainer = $('#ram_' + ramVariantId + ' .colorVariants');
    colorVariantsContainer.append(`<div id="color">
    <div id="item-color" class="form-row justify-content-center align-items-center">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name_color_var">Tên màu sắc</label>
                <input type="text" class="form-control" id="name_color_var" name="ram_variants[` + ramVariantId + `][colors][` + colorVariantsContainer.children().length + `][name]">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="price_color_var">Giá</label>
                <input type="number" class="form-control" id="price_color_var" name="ram_variants[` + ramVariantId + `][colors][` + colorVariantsContainer.children().length + `][price]">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="qty_color_var">Số lượng</label>
                <input type="number" class="form-control" id="qty_color_var" name="ram_variants[` + ramVariantId + `][colors][` + colorVariantsContainer.children().length + `][qty]">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="color_var">Màu</label>
                <input type="color" class="form-control" id="color_var" name="ram_variants[` + ramVariantId + `][colors][` + colorVariantsContainer.children().length + `][color]">
            </div>
        </div>
        <div class="col-md-1">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-right" onclick="delete_(this)">Xóa</a>
        </div>
    </div>
    </div>`);
}

function delete_(_this) {//Xóa biến thể màu sắc
    $(_this).closest('#item-color').remove();
}




// Phần cập nhật sản phẩm
function removeRamVariantUpdate(ramVariantIdUpdate) {//Xóa biến thể Ram
    // Xóa biến thể Ram theo ID
    $('#ram_update_' + ramVariantIdUpdate).remove();
}

function addColorVariantUpdate(ramVariantIdUpdate) {//Thêm biến thể màu sắc
    var colorVariantsContainer = $('#ram_update_' + ramVariantIdUpdate + ' .colorVariants');
    colorVariantsContainer.append(`<div id="color">
    <div id="item-color" class="form-row justify-content-center align-items-center">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name_color_var">Tên màu sắc</label>
                <input type="text" class="form-control" id="name_color_var" name="update_ram_variants[` + ramVariantIdUpdate + `][update][` + colorVariantsContainer.children().length + `][name]">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="price_color_var">Giá</label>
                <input type="number" class="form-control" id="price_color_var" name="update_ram_variants[` + ramVariantIdUpdate + `][update][` + colorVariantsContainer.children().length + `][price]">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="qty_color_var">Số lượng</label>
                <input type="number" class="form-control" id="qty_color_var" name="update_ram_variants[` + ramVariantIdUpdate + `][update][` + colorVariantsContainer.children().length + `][qty]">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="color_var">Màu</label>
                <input type="color" class="form-control" id="color_var" name="update_ram_variants[` + ramVariantIdUpdate + `][update][` + colorVariantsContainer.children().length + `][color]">
            </div>
        </div>
        <div class="col-md-1">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-right" onclick="deleteUpdate_(this)">Xóa</a>
        </div>
    </div>
    </div>`);
}

function deleteUpdate_(_this) {//Xóa biến thể màu sắc
    $(_this).closest('#item-color').remove();
}
