$(window).on("load", () => {

});

$(document).ready(() => {
    $('#contact').validate({
        ignore: [],
        errorElement: 'div',
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            email: {
                required: true,
                email: true,
                minlength: 5,
                maxlength: 35
            },
            message: {
                required: true,
                minlength: 5,
                maxlength: 200
            }
        },
    });

})
