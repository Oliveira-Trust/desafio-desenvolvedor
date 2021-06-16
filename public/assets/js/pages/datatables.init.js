$(document).ready(function () {
    $("#datatable").DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
    var a = $("#datatable-buttons").DataTable({ lengthChange: !1, buttons: ["copy", "excel", "pdf"] });
    $("#key-table").DataTable({ keys: !0 }),
        $("#responsive-datatable").DataTable(),
        $("#selection-datatable").DataTable({ select: { style: "multi" } }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
});