CKEDITOR.config.toolbar = 'custom';
CKEDITOR.config.toolbar_custom = [
    {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
    {
        name: 'clipboard',
        groups: ['clipboard', 'undo', 'basicstyles', 'cleanup'],
        items: [
            'Cut', 'Copy', 'Paste', 'PasteText',
            'Undo', 'Redo', 'SelectAll', 'BulletedList', 'NumberedList',
            'Bold', 'Italic', 'Underline', 'Strike', 'CopyFormatting',
            'RemoveFormat', 'SelectAll', 'JustifyLeft', 'JustifyCenter',
            'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'lineheight'
        ]
    },
];

function updateAllMessageForms() {
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
    rules: [],
    collect: [],
    show_total_cap: false,
    show_progress: false,
    image: null,
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
        $("#supported").select2("destroy");
        $("#supported").select2();
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
        $('#rules').fadeIn('slow')
        $('.create-nav-item.active').removeClass('active').next().addClass('active')

    }
});
$('#to_introduction').on('click', function () {
    $('#funds').fadeOut('fast')
    $('#introduction').fadeIn('slow')
    $('.create-nav-item.active').removeClass('active').prev().addClass('active')
})
$('#to_funds').on('click', function () {
    $('#rules').fadeOut('fast')
    $('#funds').fadeIn('slow')
    $('.create-nav-item.active').removeClass('active').prev().addClass('active')
})
$('#to_rules').on('click', function () {
    $('#settings').fadeOut('fast')
    $('#rules').fadeIn('slow')
    $('.create-nav-item.active').removeClass('active').prev().addClass('active')
})
$('.create-rule-container').validate({
    ignore: [],
    errorElement: 'span',
    rules: {
        group: {
            required: true,
        },
        min_single: {
            required: true,
        },
        max_single: {
            required: true,
        },
        fee: {
            required: true,
        },
        start_date: {
            required: true,
        },
        end_date: {
            required: true,
        },
    },
    submitHandler: function submitHandler(form, event) {
        event.preventDefault()
        let data = {
            group: $('#group').val(),
            min_single: $('#min_single').val(),
            max_single: $('#max_single').val(),
            amount_multiples: $('#amount_multiples').val(),
            contribute_counter: $('#contribute_counter').val(),
            fee: $('#fee').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val()
        }
        let item = `<div class="create-body-tab-rules-item">
                                <div class="create-body-tab-rules-item-head">
                                    ${data.group}
                                </div>
                                <div class="create-body-tab-rules-item-body">
                                    <ul>
                                        <li>
                                            <p>min Amount</p>
                                            <span>${data.min_single}</span>
                                        </li>
                                        <li>
                                            <p>max Amount</p>
                                            <span>${data.max_single}</span>
                                        </li>
                                        <li>
                                            <p>VC Fee</p>
                                            <span>${data.fee}%</span>
                                        </li>
                                        <li>
                                            <p>Start Date</p>
                                            <span>${data.start_date}</span>
                                        </li>
                                        <li>
                                            <p>END Date</p>
                                            <span>${data.end_date}</span>
                                        </li>
                                    </ul>
                                    <h3>• Allowed in multiples of ${data.amount_multiples}%</h3>
                                    <h3>• Only ${data.contribute_counter} transactions per user</h3>
                                </div>
                            </div>`
        $('.create-body-tab-rules').append(item)
        payload.rules.push(data)
        $('.create-rule').fadeOut('fast')
    }
})

$('#rules').validate({
    submitHandler: function submitHandler(form, event) {
        event.preventDefault()
        if (payload.rules.length) {
            $(form).fadeOut('fast')
            $('#settings').fadeIn('slow')
            $('.create-nav-item.active').removeClass('active').next().addClass('active')

        }
    }
})
$('#settings').validate({
    submitHandler: function submitHandler(form, event) {
        event.preventDefault()
        payload.collect = $('#collect').val()
        payload.show_total_cap = $('#total').val()
        payload.show_progress = $('#progress').val()
        $(form).fadeOut('fast')
        $('#img').fadeIn('slow')
        $('.create-nav-item.active').removeClass('active').next().addClass('active')
        $('#create_pool').prop('disabled', false)
    }
})
if (document.getElementById('img')) {
    let uploadField = document.getElementById("image");
    let blah = document.getElementById("blah")
    uploadField.onchange = function () {
        if (this.files[0].size > 2097152) {
            alert("File is too big!");
            $('.file-row-container').removeClass('hide')
            $('.delete').fadeOut('fast')
            payload.image = null
            this.value = "";
        } else {
            $('.file-row-container').addClass('hide')
            $('.delete').fadeIn('fast')
            const file = this.files[0]
            if (file) {
                payload.image = file
                blah.src = URL.createObjectURL(file)
            }
        }
    };
    $('.delete').on('click', function () {
        uploadField.value = ''
        payload.image = null
        $('.file-row-container').removeClass('hide')
        $('.delete').fadeOut('fast')
    })

}

$(document).ready(() => {
    $('.selection').select2({
        minimumResultsForSearch: -1
    })
    $('#create_rule').on('click', function () {
        $('.create-rule').fadeIn('fast')
    })
    $('.create-rule-close').on('click', function () {
        $('.create-rule').fadeOut('fast')
    })
    $('#create_pool').on('click', function (){
        let formData = new FormData();
        formData.append('title', payload.title)
        formData.append('description', payload.description)
        formData.append('address', payload.address)
        formData.append('amount', payload.amount)
        formData.append('currency', payload.currency)
        formData.append('supported', payload.supported)
        formData.append('rules', payload.rules)
        formData.append('collect', payload.collect)
        formData.append('show_total_cap', payload.show_total_cap)
        formData.append('show_progress', payload.show_progress)
        formData.append('image', payload.image)
        $.ajax({
            type: 'POST',
            url: '/create_pool',
            cache : false,
            processData: false,
            data: formData,
        }).done(function (response) {
            console.log(success)
        }).fail(function (error) {
            console.log(error)
        });

    })
})
