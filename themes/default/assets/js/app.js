require('./create_organization.js')
require('./pool.js')
require('./create_pool.js')
$(window).on("load", () => {
    setTimeout(function () {
        $('.loader').fadeOut('fast');
        $('.cubeWrap ').fadeOut('slow');
    }, 1000);
});

$(document).ready(() => {

})
