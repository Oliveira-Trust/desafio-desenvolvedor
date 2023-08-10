$(document).on('click', '.link-icon-ajax', function (e) {
    e.preventDefault();

    const $this = $(this);
    /*if ($this.data('block') === 1) {
        return false;
    }*/


    const fa = $this.find('.fa');
    if (fa.length) {
        fa.removeClass('fa').addClass('far');
    } else {
        const far = $this.find('.far');
        if (far.length) {
            far.removeClass('far').addClass('fa');
        }
    }

    let url = $this.data('url');
    if (url === undefined) {
        url = $this.attr('href');
    }

    //$this.data('block', 1);


    $.ajax({
        type: 'GET',
        url: url,
        success: function (e) {

            /*if (e.html) {
                $this.html(e.html)
            }*/
            //$this.data('block', 0);
        },

        error: function () {
            const fa = $this.find('.fa');
            if (fa.length) {
                fa.removeClass('fa').addClass('far');
            } else {
                const far = $this.find('.far');
                if (far.length) {
                    far.removeClass('far').addClass('fa');
                }
            }

            //$this.data('block', 0);
            (new PNotify({
                title: 'Error',
                text: 'Erro ao adicionar aos favoritos. Tente novamente',
                type: 'error'
            })).get()

        },
        timeout: 5000
    });
});

//INPUT SUBMIT ON CHANGE
//WaitMe
$('.submit-wait').submit(function () {
    const btn = $(this).find('[type="submit"]');
    let btn_val_load = btn.data('load2') ?? 'Salvando...';
    btn.val(btn_val_load).prop('disabled', true);

    $(this).waitMe();
});

$('.submit-onchange').change(function () {
    /*const content = $(this).closest('.table-content')
    if (content) {
        content.waitMe();
    }*/
    $(this).closest('form').submit();
});

$('.table-submit-onchange').change(function () {
    $(this).closest('.table-content').find('.table-content-load').waitMe();
    $(this).closest('form').submit();
});

function clear_form_elements(ele) {
    $(ele).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

//$('form.submit-ajax').on('submit', function (e) {
$(document).on('submit', 'form.submit-ajax', function (e) {
    e.preventDefault();

    const $this = $(this);
    let $wait = $this;

    $wait.waitMe();
    const btn = $this.find('[type="submit"]');
    const btn_val_default = btn.val();
    let btn_val_load = btn.data('load');
    btn_val_load = btn_val_load ? btn_val_load : 'Salvando...'
    const body = $this.find('.content-fields'); //.rbox-body
    btn.val(btn_val_load).prop('disabled', true);
    $this.find('.invalid-feedback').remove();
    $this.find('.is-invalid').removeClass('is-invalid');

    $.ajax({
        type: $this.attr('method'),
        url: $this.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        //data: $(this).serialize(),
        success: function (e) {

            if (e.html) {
                $wait.html(e.html);
                if (e.msg) {
                    (new PNotify({
                        text: e.msg,
                        type: e.type,
                        styling: 'bootstrap3'
                    })).get();
                }
            }
            else if (e.url) {
                window.location.replace(e.url);
            } else if (e.msg) {
                body.find('.alert').remove();
                body.prepend('<div class="alert alert-success alert-important" role="alert"><button type="button" class="close" data-dismiss="alert" ariahidden="true">×</button>' + e.msg + '</div>');

                if (e.clear) {
                    clear_form_elements($this);
                }
                $wait.waitMe("hide");
                btn.val(btn_val_default).prop('disabled', false);
            } else if (e.popup) {
                (new PNotify({
                    text: e.popup,
                    type: 'success',
                    styling: 'bootstrap3'
                })).get();
                $.magnificPopup.close()
            }

        },
        error: function (e) {

            body.find('.alert').remove();
            $wait.waitMe("hide");
            btn.val(btn_val_default).prop('disabled', false);

            let errors = e.responseJSON.errors;

            for (var key in errors) {
                var firstElement = key;
                break;
            }

            for (var key in errors) {


                let input = $this.find("[data-field='" + key + "']");

                if (!input.length) {
                    input = $this.find('[name="' + key + '"]');
                }
                /*if (!input.length) {
                    input = $this.find('[name="' + key + '[]"]');
                }*/
                const form_group = input.closest('.form-group');
                //const div = input.closest('div:not(.input-group)')
                const div = input.closest('div');
                input.addClass('is-invalid');
                form_group.addClass('is-invalid');
                const e = errors[key];

                if (e && e.length) {
                    div.append('<div class="invalid-feedback">' + (e.length == 1 ? e : e.join('<br>')) + '</div>');
                }


            }
            // PNotify.prototype.options.styling = "bootstrap3";

            /*(new PNotify({
                title: 'Error',
                text: 'Verifique os campos marcados',
                type: 'error'/!*,
                styling: 'bootstrap3'*!/
            })).get();*/

            //move cursor to top page javascript

            let firstElementObj = $this.find('[name="' + firstElement + '"]');
            if (!firstElementObj.length) {
                firstElementObj = $this.find("[data-field='" + firstElement + "']");
            }

            if (firstElementObj.length) {

                $('html, body').animate({
                    scrollTop: firstElementObj.offset().top - 120
                }, 200);
                firstElementObj.focus();
            } else {

                window.scroll({
                    top: 50,
                    left: 0,
                    behavior: 'smooth'
                });
            }

        }
    });
});

//FORM SUBMIT DISABLE
$(".submit-disable:not('.submit-ajax')").submit(function () {
    var btn = $(this).find('input[type="submit"]');
    var btn_val_load = btn.data('load');
    btn_val_load = btn_val_load ? btn_val_load : 'Salvando...';


    btn.val(btn_val_load).prop('disabled', true);
    //return true;
});
