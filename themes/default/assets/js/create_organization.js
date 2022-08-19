if(document.getElementById('organization')){
    let uploadField = document.getElementById("file");
    let blah = document.getElementById("blah")
    uploadField.onchange = function() {
        if(this.files[0].size > 2097152){
            alert("File is too big!");
            $('.file-row-container').removeClass('hide')
            $('.delete').fadeOut('fast')
            this.value = "";
        }
        else{
            $('.file-row-container').addClass('hide')
            $('.delete').fadeIn('fast')
            const file = this.files[0]
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    };
    $('.delete').on('click', function (){
        uploadField.value = ''
        $('.file-row-container').removeClass('hide')
        $('.delete').fadeOut('fast')
    })

}
$('#organization').validate({
    ignore: [],
    errorElement: 'span',
    rules: {
        name: {
            required: true,
            minlength: 2,
            maxlength: 20
        },
        description: {
            required: true,
            minlength: 10,
            maxlength: 22
        },
        website: {
            required: true,
            minlength: 5,
            maxlength: 35
        },
        logo: {
            required: true,
        },
        email: {
            required: true,
            email: true,
            minlength: 5,
            maxlength: 35
        },
        discord: {
            minlength: 5,
            maxlength: 50
        },
        telegram: {
            minlength: 5,
            maxlength: 50
        },
    },
});
