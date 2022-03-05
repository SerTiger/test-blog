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
        submitHandler: function submitHandler(form, event) {
            event.preventDefault();
            $('.btn.btn-blue').addClass('load');
            $.ajax({
                type: 'POST',
                url: '/api/contact',
                data: $(form).serialize()
            }).done(function (response) {
                $('.btn.btn-blue').removeClass('load')
                $('.thanks').fadeIn('fast')
                $('body').addClass('fixed-body')

            }).fail(function (error) {
                $('.btn.btn-blue').removeClass('load')
            });
        }
    });

})
