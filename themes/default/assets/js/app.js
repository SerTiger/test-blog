require('./create_organization.js')
require('./pool.js')
require('./create_pool.js')
require('./profile.js')
require('./web3app.js')

$(window).on("load", () => {
    setTimeout(function () {
        $('.loader').fadeOut('fast');
        $('.cubeWrap ').fadeOut('slow');
    }, 1000);
});

$(document).ready(() => {
    $('.await-notification-close').on('click', function () {
        $(this).parents('.await-notification').removeClass('active')
    })
    let root = document.querySelector(':root');
    if (localStorage.getItem('theme')) {
        let theme = localStorage.getItem('theme')
        if (theme !== 'light') {
            $('.theme-toggler').addClass('active')
            root.setAttribute('data-theme', 'dark')
        } else {
            $('.theme-toggler').removeClass('active')
            root.setAttribute('data-theme', 'light')
        }
    } else {
        localStorage.setItem('theme', 'dark')
        root.setAttribute('data-theme', 'dark')
    }
    $('.theme-toggler').on('click', function () {
        $(this).toggleClass('active')
        if ($(this).hasClass('active')) {
            localStorage.setItem('theme', 'dark')
            root.setAttribute('data-theme', 'dark')
        } else {
            localStorage.setItem('theme', 'light')
            root.setAttribute('data-theme', 'light')
        }
    })

    $('[data-toggle="datepicker"]').datepicker({
        startView: 2,
    });
    $('.header-wallet-wrap').on('click', function () {
        $('.header-wallet-dropdown').slideToggle()
    })
    $('.header-btns-wrap').on('click', function () {
        $('.header-btns-dropdown').slideToggle()
    })

    $('.burger').on('click', function (){
        $(this).toggleClass('active')
        $('body').toggleClass('fixed-body')
        $('.sidebar').toggleClass('active')
    })
})
