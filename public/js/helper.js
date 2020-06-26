// statusHelper
function getEnable(value) {
    return '<h4><span class="badge badge-pill badge-' + getStatusClass(value) + '">' + lang.enable[value] + '</span></h4>';
}

function getStatus(value) {
    return '<h4><span class="badge badge-pill badge-' + getStatusClass(value) + '">' + lang.status[value] + '</span></h4>';
}

function getStatusClass(value) {
    switch (value) {
        case 1:
            return 'success';
            break;
        case 2:
            return 'warning';
            break;
        case 3:
            return 'success';
            break;
        case 4:
            return 'danger';
            break;
        default:
            return 'danger'
    }
}

function getRefTables(value) {
    return ref_tables[value];
}

// priceHelper
function formatMoneyBr(valor, comMoeda = true) {
    valor = parseFloat(valor);
    if ($.isNumeric(valor)) {
        if (comMoeda) {
            return valor.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }
        return valor.toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
    }
    return 'error';
}

// modalHelper
$('#modal-base').on('hidden.bs.modal', function () {
    $('#modal-base #modal-title, #modal-base #modal-body').text('');
});

function addModal(title, text) {
    $('#modal-base #modal-title').text(title);
    $('#modal-base #modal-body').html(text);
    $('#modal-base').modal('show');
}