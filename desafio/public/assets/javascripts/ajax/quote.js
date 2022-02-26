$("#money").maskMoney({thousands:'.', decimal:',', affixesStay: false});

$('.quote').on('click', function (e) {
    e.preventDefault()
    let button = $(this)
    let form = $('#formQuote')
    validation(form)

    if (! form.valid())
        return false; 

    $.ajax({
        url: '/cotacoes',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: form.serialize(),
        beforeSend: function () {
            button.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> AGUARDE')
        },
        error: function (data) {
            button.attr('disabled', false).html('<i class="fa fa-send"></i> COTAR')
            swal("", data.responseJSON.message, "warning");
        },
        success: function (data) {
            button.attr('disabled', false).html('<i class="fa fa-send"></i> COTAR')
            $('#detail').html(data)
        }
    })
})

function validation(form) {
    form.validate({
        highlight: function(element) {
            $(element).closest('.i-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.i-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
}

$('#detail').on('click', '.sendmail', function () {
    let button = $(this)
    let quote  = button.data('quote')

    $.ajax({
        url: `/cotacoes/email/enviar/${quote}`,
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            button.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> AGUARDE')
        },
        error: function (data) {
            button.attr('disabled', false).html('<i class="fa fa-envelope"></i> ENVIAR COTAÇAO VIA E-MAIL')
            swal("", data.responseJSON.message, "warning");
        },
        success: function (data) {
            button.attr('disabled', false).html('<i class="fa fa-envelope"></i> ENVIAR COTAÇAO VIA E-MAIL')
            swal("", `Cotação enviada para o e-mail ${data.email}`, "success").then(function () {
                location.reload()
            });
        }
    })
})