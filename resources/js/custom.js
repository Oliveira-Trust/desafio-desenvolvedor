$("#menu-toggle").on("click", function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(".restore").on("click", function (event) {
    event.preventDefault();
    $("#record-name").val($(this).attr('data-name'));
    $("#frm-restore").attr("action", $(this).attr("data-route"));
});

$("#btn-restore").on("click", function () {
    $(this).prop('disabled', true).html('Aguarde...');
    $("#frm-restore").trigger("submit");
});

$(".delete").on("click", function (event) {
    event.preventDefault();
    $("#record-name-delete").val($(this).attr('data-name-delete'));
    $("#frm-delete").attr("action", $(this).attr("data-route-delete"));
});

$("#btn-delete").on("click", function () {
    $(this).prop('disabled', true).html('Aguarde...');
    // $('#frm-delete').submit();
    $("#frm-delete").trigger("submit");
});

setTimeout(function () {
    $("#alert").alert('close');
}, 3000);

$('.select2').select2({
    theme: 'bootstrap4',
});

if ($('#table').length) {
    massDelete();
    var table = $('#table').DataTable();
    $('#table tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
        massDelete();
    });

    function massDelete() {
        if ($('#table tbody tr').hasClass('selected')) {
            $('#mass-delete').removeClass('d-none');
        } else {
            $('#mass-delete').addClass('d-none');
        }
    }

    $('#mass-delete').on("click", function () {
        let row = $('#table tbody tr.selected');
        if (row.length > 0) {
            row.each(function (i, element) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: $(this).attr('delete-id'),
                    dataType: 'json',
                    success: function (msg) {
                        location.reload();
                    }
                });
            });
        }
    });

}
