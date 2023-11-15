// $(document).ready(function () {
//     $("#home-slide").carousel({
//         interval: 4000,
//         ride: "carousel"
//     });
// });

$('div #ride-thumb').click(function () {
    let imgPath = $(this).attr('src');
    $(this).addClass("border-danger")
    $('div #ride-thumb').not(this).removeClass("border-danger")
    $('#thumb-img-now').attr('src', imgPath);
});


function nextBtn(event) {
    var img = document.querySelectorAll('#ride-thumb');
    var target = event.target;
}

function minus() {
    let v = document.getElementById('num-order').value;
    v = Number(v);
    if (v > 1) {
        document.getElementById('num-order').value = v - 1;
    }
}
function plus() {
    let v = document.getElementById('num-order').value;
    let max = document.getElementById('quantity').innerText;
    v = Number(v);
    max = Number(max);
    if (v < max) {
        document.getElementById('num-order').value = v + 1;
    }
}

var element = document.getElementById("slick-slider");

function prevSlide() {
    var slides = document.querySelectorAll('.slide');
    document.getElementById("slick-slider").appendChild(slides[0]);
}

function nextSlide() {
    var slides = document.querySelectorAll('.slide');
    document.getElementById("slick-slider").prepend(slides[slides.length - 1]);
}

setInterval(nextSlide, 3000);
