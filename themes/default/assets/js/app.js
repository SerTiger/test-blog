require('./create_organization.js')
require('./pool.js')
require('./create_pool.js')
require('./profile.js')
import Web3 from 'web3/dist/web3.min.js'
window.Web3 = Web3;

$(window).on("load", () => {
    setTimeout(function () {
        $('.loader').fadeOut('fast');
        $('.cubeWrap ').fadeOut('slow');
    }, 1000);
});

$(document).ready(() => {
    $('.await-notification-close').on('click', function (){
        $(this).parents('.await-notification').removeClass('active')
    })
})
$('[data-toggle="datepicker"]').datepicker({
    startView: 2,
});
$('.header-wallet-wrap').on('click', function (){
    $('.header-wallet-dropdown').slideToggle()
})
$('.header-btns-wrap').on('click', function (){
    $('.header-btns-dropdown').slideToggle()
})
