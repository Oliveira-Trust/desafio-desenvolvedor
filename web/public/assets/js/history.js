class History {
    constructor() {
        this.init();
    }

    init() {
        this.bindUI();
    }

    bindUI() {
        $(function () {
            $("#historyTable").DataTable({
                "ajax": `${API_URL}/orders?user_id=${USER_ID}`,
                "columns": [
                    { "data": "codein" },
                    { "data": "code" },
                    { "data": "bid" },
                    { "data": "description" },
                    { "data": "value" },
                    { "data": "value_converted" },
                    { "data": "total_tax" },
                    { "data": "payment" }
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            })
            .buttons()
            .container()
            .appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    }
}

new History();
