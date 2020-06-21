$('.collapsedCustom').on('show.bs.collapse', function (event) {
    changeStateButton($(event.target).data(), true);
});
$('.collapsedCustom').on('hide.bs.collapse', function (event) {
    changeStateButton($(event.target).data(), false);
});

function changeStateButton(data, open) {
    let button = $('#' + data.customRef);
    if (open) {
        button.text(button.data().textClose);
        $('.dataTables_wrapper').hide();
        return;
    }
    button.text(button.data().textOpen);
    $('.dataTables_wrapper').show();
    return;
}
