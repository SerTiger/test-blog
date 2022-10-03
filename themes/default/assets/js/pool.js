$(function() {
    $('.pool-more-head').on('click', function () {
        $(this).next('.pool-more-body').slideToggle()
    });


    $('.pool-status').on('click', function (e) {
        e.preventDefault();
        let uri = $(this).attr('href');
        personal_sign(function(){
            $.ajax({
                type: 'POST',
                url: uri,
                cache : false,
                data: {
                    'address': window.ethereum.selectedAddress,
                    'signature': window.nonce,
                },
            }).done(function (response) {
                window.location.reload();
            }).fail(function (error) {
                console.log(error)
            });
        })

        return false;
    });

    if(ClipboardJS) {
        new ClipboardJS('.copy-js');
    }

    $('.pool-contribute').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var actionUrl = $form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: $form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data.error) {
                    alert2(data.error);
                } else {
                    window.transaction_sign(
                        data.transactions,
                        data.link
                    );
                }
            }
        });
        return false;
    })
});
