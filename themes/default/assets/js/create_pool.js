CKEDITOR.config.toolbar = 'custom';
CKEDITOR.config.toolbar_custom = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items:['Source'] },
    {
        name: 'clipboard',
        groups: [ 'clipboard', 'undo', 'basicstyles', 'cleanup'],
        items: [
            'Cut', 'Copy', 'Paste', 'PasteText',
            'Undo', 'Redo', 'SelectAll', 'BulletedList', 'NumberedList',
            'Bold', 'Italic', 'Underline', 'Strike', 'CopyFormatting',
            'RemoveFormat', 'SelectAll', 'JustifyLeft', 'JustifyCenter',
            'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'lineheight'
        ] },
];
function updateAllMessageForms()
{
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
}
let payload = {
    title: '',
    description: '',
    address: '',
    amount: null,
    currency: null,
    supported: null,
}

$('#introduction').validate({
    ignore: [],
    errorElement: 'span',
    rules: {
        title: {
            required: true,
            minlength: 2,
            maxlength: 25
        },
    },
    submitHandler: function submitHandler(form, event) {
        updateAllMessageForms()
        event.preventDefault()
        payload.title = $('#title').val()
        payload.description = $('#description').val()
        $(form).fadeOut('fast')
        $('#funds').fadeIn('slow')
        $('.create-nav-item.active').removeClass('active').next().addClass('active')
    }
});
$('#funds').validate({
    ignore: [],
    errorElement: 'span',
    rules: {
        address: {
            required: true,
            minlength: 2,
            maxlength: 50
        },
        amount: {
            required: true,
        },
        currency: {
            required: true,
        },
        supported: {
            required: true,
        },
    },
    submitHandler: function submitHandler(form, event) {
        event.preventDefault()

        payload.address = $('#address').val()
        payload.amount = $('#amount').val()
        payload.currency = $('#currency').val()
        payload.supported = $('#supported').val()
        console.log(payload);
        $(form).fadeOut('fast')
        // $('#funds').fadeIn('slow')
        $('.create-nav-item.active').removeClass('active').next().addClass('active')

    }
});
$('#to_introduction').on('click', function (){
    $('#funds').fadeOut('fast')
    $('#introduction').fadeIn('slow')
    $('.create-nav-item.active').removeClass('active').prev().addClass('active')
})
$(document).ready(() => {
    $('.selection').select2({
        minimumResultsForSearch: -1
    })
})
