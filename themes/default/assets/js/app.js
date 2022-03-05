require('./contact')
$(window).on("load", () => {
    setTimeout(function () {
        $('.loader').fadeOut('fast');
        $('.cubeWrap ').fadeOut('slow');
    }, 1000);
});

$(document).ready(() => {
    AOS.init()
    window.addEventListener('scroll',()=>{
        window.scrollY > 130 ? $('.header').addClass('fixed') : $('.header').removeClass('fixed')
    })
    window.scrollY > 130 ? $('.header').addClass('fixed') : ''
    $('.scroll-down').on('click', function (){
        window.scrollTo({
            top: 700,
            behavior: "smooth"
        });
    })
})
