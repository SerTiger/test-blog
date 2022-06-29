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

$(document).ready(() => {
    $('.selection').select2()
})
