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

function formatMoneyToDB(valor) {
    return valor.replace('.', '').replace(',', '.');
}

// collapsedHelper
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

// toastHelper
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

// modalHelper
$('#modal-base').on('hidden.bs.modal', function () {
    $('#modal-base #modal-title, #modal-base #modal-body').text('');
});

function addModal(title, text) {
    $('#modal-base #modal-title').text(title);
    $('#modal-base #modal-body').html(text);
    $('#modal-base').modal('show');
}

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

// formHelper
async function clearForm(formId) {
    $(formId + ' input:not(#user_id), ' + formId + ' select').val('').trigger('change');
    $(formId + ' #type-request').val('new').trigger('change');
}

async function editData(el) {
    try {
        let element = $(el);
        let url = show_path.replace('#UUID#', element.data().uuid);
        let response = await getData(url);
        fillItem(response);
        return;
    } catch (error) {
        console.error(error);
    }
}

async function deleteData(el) {
    try {
        let element = $(el);
        let url = show_path.replace('#UUID#', element.data().uuid);
        await sendItem(url, {}, 'DELETE');
        return;
    } catch (error) {
        console.error(error);
    }
}

async function getData(url) {
    try {
        let response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            }
        });
        response = await response.json();
        return await resolveResult(response);
    } catch (error) {
        console.error(error);
    }
}

async function postData(url, dataJson, type = 'POST') {
    try {
        let response = await fetch(url, {
            method: type,
            body: JSON.stringify(dataJson),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            }
        });
        response = await response.json();
        return await resolveResult(response, type == 'DELETE' ? true : false);
    } catch (error) {
        console.error(error);
    }
}

async function resolveResult(response, returnToast = false) {
    if (typeof response.success != 'undefined') {
        if (response.success.status) {
            if (returnToast) {
                addToast('bg-success', 'Sucesso!', ' ', response.success.message);
                return {};
            }
            return response.success.content;
        }
        addToast('bg-danger', 'Error', ' ', response.success.message);
        return {};
    }
    addToast('bg-danger', 'Error', ' ', response.error.message);
    return {};
}
