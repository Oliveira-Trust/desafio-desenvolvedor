$('#toast-message').on('hidden.bs.toast', function () {
    $('#toast-message #toast-header').removeClass().addClass('toast-header');
    $('#toast-message #title, #toast-message #sub-title, #toast-message #text').text('');
    $('#toast-message').attr('data-delay', '3000');
});

function addToast(classHeader, title, subtitle, text, delay = '3000') {
    let arrayBgColor = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-info', 'bg-dark'];
    $('#toast-message').attr('data-delay', delay);
    if ($.inArray(classHeader, arrayBgColor)) {
        $('#toast-message #toast-header').addClass('text-white');
    }
    $('#toast-message #toast-header').addClass(classHeader);
    $('#toast-message #title').text(title);
    $('#toast-message #sub-title').text(subtitle);
    $('#toast-message #text').text(text);
    $('#toast-message').toast('show');
}
