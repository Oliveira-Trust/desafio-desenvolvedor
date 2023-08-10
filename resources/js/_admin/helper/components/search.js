//INPUT CLEAR BUTTON
$('.has-clear input[type="text"]').on('input propertychange', function () {
    var $this = $(this);
    var visible = Boolean($this.val());
    $this.siblings('.form-control-clear').toggleClass('hidden d-none', !visible);
}).trigger('propertychange');

$('.form-control-clear').click(function () {
    $(this).siblings('input[type="text"]').val('').trigger('propertychange').focus().keyup();
    //$(this).closest('form').submit();
});

function delay(fn, ms) {
    let timer = 0
    return function (...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}


$(document).ready(function () {
    /*$(".table-search").keyup(function (e) {*/
    $('.table-content').on('keyup', '.table-search', delay(function (e) {
        if (e.keyCode != 13) {
            const val = $(this).val();
            if (val.length >= 0) {
                const content = $(this).closest('.table-content');
                const content_load = content.find('.table-content-load');
                content_load.waitMe();
                const currentUrl = window.location.href;
                const url = new URL(currentUrl);
                url.searchParams.delete("page"); //não acha a pesquisa se estiver na pagina 2


                if (val === '') {
                    url.searchParams.delete('s');
                } else {
                    url.searchParams.set("s", val); // setting your param
                }

                const newUrl = url.href;
                window.history.pushState("", "", newUrl);

                $.ajax({
                    type: 'GET',
                    url: newUrl,
                    success: function (e) {
                        content_load.html(e);

                        content_load.mark(val, {
                            exclude: [
                                ".highlight-igone",
                            ],
                            /*className: ".highlight"*/
                        });
                        content_load.waitMe('hide');

                    },

                    error: function (e) {
                        content_load.waitMe('hide');
                    },
                    timeout: 10000
                });
            }
        }
    }, 500));
});
