$(window).on("load", () => {

});

$(document).ready(() => {
    $('#inquire_1').validate({
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
            phone: {
                required: true,
                minlength: 10,
                maxlength: 14,
            },
            telegram: {
                required: true,
                minlength: 2,
                maxlength: 25,
            },
            company: {
                required: true,
                minlength: 2,
                maxlength: 30
            },
            position: {
                required: true,
                minlength: 2,
                maxlength: 30
            },

        },
    });

})
