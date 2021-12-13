const historyMethods = {
    drawHistoryTable () {
        $('.history-table').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            ajax: '/currency-exchange/logs',
            columns: [
                { data: 'origin_currency' },
                { data: 'destination_currency' },
                { data: 'origin_currency_value' },
                { data: 'payment_method' },
                { data: 'destination_currency_base_value' },
                { data: 'converted_value' },
                { data: 'payment_tax' },
                { data: 'conversion_tax' },
                { data: 'origin_currency_net_value' }
            ],
            columnDefs: [
                {
                    targets: 2,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    targets: 4,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    targets: 5,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    targets: 6,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    targets: 7,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
                {
                    targets: 8,
                    render: $.fn.dataTable.render.number('.', ',', 2, '')
                },
            ],
            language: {
                lengthMenu: 'Mostrar _MENU_ registros por página',
                zeroRecords: 'Nada encontrado',
                info: 'Mostrando página _PAGE_ de _PAGES_',
                infoEmpty: 'Sem registros disponíveis',
                infoFiltered: '(filtrados de _MAX_ total de registros)',
                search: 'Pesquisa: ',
                paginate: { previous: 'Anterior', next: 'Próxima' },
            }
        });
    }
};

$(document).ready(() => {
    historyMethods.drawHistoryTable();
});
