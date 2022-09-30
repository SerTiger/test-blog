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
    id: '',
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

$(document).ready(() => {
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
        //$('.create-body-tab-rules').append(item)
        //payload.rules.push(data)
        $('.create-body-tab-rules').html(item)
        payload.rules = [data]
        $('.create-rule').fadeOut('fast')

        $('#create_rule').attr('disabled',true);
    }
})

$('#rules').validate({
    submitHandler: function submitHandler(form, event) {
        event.preventDefault()
        if (payload.rules.length) {
            $(form).fadeOut('fast')
            $('#settings').fadeIn('slow')
            $('.create-nav-item.active').removeClass('active').next().addClass('active')

            $('#create_rule').attr('disabled',true);
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
    });

$(document).ready(() => {
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
});

let formatState = function(opt) {
    var optimage = $(opt.element).attr('data-image');

    if (!optimage) {
        return opt.text;
    } else {
        var $opt = $(
            '<span class="img-wrap"><img src="' + optimage + '" width="30px" style="vertical-align:middle" /> ' + opt.text + '</span>'
        );
        return $opt;
    }
}

$(document).ready(() => {
    $('.selection').select2({
        minimumResultsForSearch: -1,
        templateResult: formatState,
        templateSelection: formatState
    })

    $(document).on('click', '.create-body-tab-rules-item',function () {
            $('.create-rule').fadeIn('fast')
    })

    $('#create_rule').on('click', function () {
        if(payload.rules.length === 0)
            $('.create-rule').fadeIn('fast')
    })
    $('.create-rule-close').on('click', function () {
        $('.create-rule').fadeOut('fast')
    })
    $('#create_pool').on('click', function (){
        payload.id = $(this).data('id');

        let formData = new FormData();
        formData.append('id', payload.id)
        formData.append('title', payload.title)
        formData.append('description', payload.description)
        formData.append('address', payload.address)
        formData.append('amount', payload.amount)
        formData.append('currency',  payload.currency)
        payload.supported.forEach(coin=> {
            formData.append('supported[]', coin)
        });
        payload.rules.forEach(rule => {
            formData.append('rules[]', JSON.stringify(rule))
        });
        payload.collect.forEach(field => {
            formData.append('collect[]', field)
        })
        formData.append('show_total_cap', payload.show_total_cap)
        formData.append('show_progress', payload.show_progress)
        if(payload.image) formData.append('image', payload.image)

        let uri = $(this).data('action');

        personal_sign(function(){
            formData.append('address', window.ethereum.selectedAddress);
            formData.append('signature', window.nonce);

            $.ajax({
                type: 'POST',
                url: uri,
                cache : false,
                contentType: false,
                processData: false,
                data: formData,
            }).done(function (response) {
                window.location.href = response.redirect;
            }).fail(function (error) {
                console.log(error)
            });
        });

    })

    if($('#update_pool').length) {
        $('#introduction').trigger('submit');
        $('#funds').trigger('submit');
        $('#settings').trigger('submit');
        let rules = $('#rules').serializeArray();
        rules.forEach(item=>{
            payload.rules.push(JSON.parse(item.value))
        })

        $('#update_pool').prop('disabled',false);

        $('#settings').fadeOut('fast')
        $('#funds').fadeOut('fast')
        $('#introduction').fadeIn('fast')
        $('#rules').fadeOut('fast')
        $('#img').fadeOut('fast')
        $('.create-nav-item').removeClass('active').first().addClass('active')
    }

    $('#update_pool').on('click', function (){
        payload.id = $(this).data('id');

        let formData = new FormData();
        formData.append('id', payload.id)
        formData.append('title', payload.title)
        formData.append('description', payload.description)
        formData.append('address', payload.address)
        formData.append('amount', payload.amount)
        formData.append('currency',  payload.currency)
        payload.supported.forEach(coin=> {
            formData.append('supported[]', coin)
        });
        payload.rules.forEach(rule => {
            formData.append('rules[]', JSON.stringify(rule))
        });
        payload.collect.forEach(field => {
            formData.append('collect[]', field)
        })
        formData.append('show_total_cap', payload.show_total_cap)
        formData.append('show_progress', payload.show_progress)
        formData.append('image', payload.image)

        let uri = $(this).data('action');
        $.ajax({
            type: 'POST',
            url: uri,
            cache : false,
            contentType: false,
            processData: false,
            data: formData,
        }).done(function (response) {
            window.location.href = response.redirect;
        }).fail(function (error) {
            console.log(error)
        });

    })
})
