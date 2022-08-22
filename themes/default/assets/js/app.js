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

if(window.ethereum) {
    window.ethereum.on('accountsChanged', function (accounts) {
        let address = accounts[0];

        // Sign message
        $.ajax({
            type: 'POST',
            url: '/metamask/ethereum/switch',
            cache: false,
            data: {
                'address': address,
                'chainId': window.ethereum.networkVersion
            },
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            console.log(error)
        });

    });

    window.ethereum.on('chainChanged', function (chainId) {
        let address = window.ethereum.selectedAddress;

        // Sign message
        $.ajax({
            type: 'POST',
            url: '/metamask/ethereum/switch',
            cache: false,
            data: {
                'address': address,
                'chainId': chainId
            },
        }).done(function (response) {
            window.location.reload(true);
        }).fail(function (error) {
            console.log(error)
        });

    });
}

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
})

