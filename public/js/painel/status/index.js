var show_path = 'status/#UUID#';

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
    if (!$('#open-insert').hasClass('collapsed')) {
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
