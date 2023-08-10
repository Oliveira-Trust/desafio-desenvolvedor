
$(".disable-link").click(function (e) {
    if ($(this).attr('onlyread') === 'disabled') {
        e.preventDefault();
    } else {
        $(this).addClass('disabled').attr('disabled', 'disabled');
    }
});

