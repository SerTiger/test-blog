$(window).on("load", () => {

});

$(document).ready(() => {
    $('#inquire_2').validate({
        ignore: [],
        errorElement: 'div',
        rules: {
            project_name: {
                required: true,
                minlength: 2,
                maxlength: 35
            },
            site: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
        },
    });

})
