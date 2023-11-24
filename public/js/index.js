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
