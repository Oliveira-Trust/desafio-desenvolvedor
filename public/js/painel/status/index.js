var show_path = 'status/#UUID#';

function getEnable(value) {
    if (value) {
        return '<h4><span class="badge badge-pill badge-success">Enable</span></h4>';
    }
    return '<h4><span class="badge badge-pill badge-danger">Disable</span></h4>';
}

function getStatus(value) {
    if (value) {
        return '<h4><span class="badge badge-pill badge-success">Active</span></h4>';
    }
    return '<h4><span class="badge badge-pill badge-danger">Inactive</span></h4>';
}

async function saveItem() {
    let dataJson = {
        'name': $('#name').val(),
        'ref_table': $('#ref_table').val(),
        'enable': $('#enable').val(),
        'status': $('#status').val()
    }
    if ($('#type-request').val() == 'new') {
        sendItem('status', dataJson);
        return;
    }
    dataJson.uuid = $('#uuid').val();
    sendItem('status/' + dataJson.uuid, dataJson, 'PUT');
    return;
}

async function sendItem(url, dataJson, type = 'POST') {
    let httpCall = await postData(url, dataJson, type);
    if ($('#open-insert').hasClass('collapsed') && type != 'DELETE') {
        $('#open-insert').click();
    }
    if (!$('#open-insert').hasClass('collapsed') && type == 'DELETE') {
        $('#open-insert').click();
    }
    $('.buttons-reload').click();
    clearForm('#status-create');
}

async function fillItem(dataJson) {
    $('#type-request').val('update');
    $('#uuid').val(dataJson.uuid);
    $('#name').val(dataJson.name);
    $('#ref_table').val(dataJson.ref_table);
    $('#enable').val(dataJson.enable);
    $('#status').val(dataJson.status);
    if ($('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
}
