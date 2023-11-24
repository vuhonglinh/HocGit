function quickView(_this) {//Phần QuickView
    var product_id = $(_this).val();
    var data = { product_id: product_id };
    $.ajax({
        url: '?mod=product&action=quickView_ajax',
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function (data) {
            $("#product_img").html("<img src='admin/img/" + data.product_img + "' alt=''>");
            $("#product_name").html(data.product_name);
            $("#product_price").html(data.product_price);
            $("#product_star").html(data.product_star);
            $("#product_reviews").html(data.product_reviews);
            $("#product_desc").html(data.product_desc);
            $("#string_variant_ram").html(data.string_variant_ram);
            selectVar()
            $("#string_variant_color").html(`<h4 class="tp-product-details-action-title mt-15">Màu sắc :</h4>
            <div class="tp-product-details-variation" id="color_var"></div>`);
        }
    });
}

function favourite(_this) {
    var product_id = $(_this).val();
    var data = { product_id: product_id };
    $.ajax({
        url: '?mod=cart&action=favourite_ajax',
        method: 'POST',
        data: data,
        dataType: 'html',
        success: function (data) {
            console.log(data);
        }
    });
}
