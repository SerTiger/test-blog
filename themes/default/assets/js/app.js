$(window).on("load", () => {
    setTimeout(function () {
        $('.loader').fadeOut('fast');
        $('.cubeWrap ').fadeOut('slow');
    }, 1000);
});

$(document).ready(() => {
    window.addEventListener('scroll',()=>{
        window.scrollY > 130 ? $('.header').addClass('fixed') : $('.header').removeClass('fixed')
    })

})
