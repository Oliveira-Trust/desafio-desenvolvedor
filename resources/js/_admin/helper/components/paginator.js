
$('.table-content').on('click','.page-link',function (e) {
    e.preventDefault();
    const url = $(this).attr('href');

    if (url === undefined) {
        return  false;
    }

    const content = $(this).closest('.table-content');
    const content_load = content.find('.table-content-load');
    content_load.waitMe();
    window.history.pushState("", "", url);

    $.ajax({
        type: 'GET',
        url: url,
        success: function (e) {
            content_load.html(e);
            content_load.waitMe('hide');
        },

        error: function (e) {
            content_load.waitMe('hide');
        },
        timeout: 10000
    });
})
