var show_path = 'cliente/#UUID#';

function getStatus(value) {
    if (value) {
        return '<h4><span class="badge badge-pill badge-success">Active</span></h4>';
    }
    return '<h4><span class="badge badge-pill badge-danger">Inactive</span></h4>';
}

async function saveItem() {
    console.log($('#dob').val());
    let dataJson = {
        'name': $('#name').val(),
        'dob': $('#dob').val(),
        'user_id': $('#user_id').val(),
        'status_id': $('#status_id').val()
    }
    if ($('#type-request').val() == 'new') {
        sendItem('cliente', dataJson);
        return;
    }
    dataJson.uuid = $('#uuid').val();
    sendItem('cliente/' + dataJson.uuid, dataJson, 'PUT');
    return;
}

async function sendItem(url, dataJson, type = 'POST') {
    let httpCall = await postData(url, dataJson, type);
    if (!$('#open-insert').hasClass('collapsed') && type != 'DELETE') {
        $('#open-insert').click();
    }
    if (!$('#open-insert').hasClass('collapsed') && type == 'DELETE') {
        $('#open-insert').click();
    }
    $('.buttons-reload').click();
    clearForm('#client-create');
}

async function fillItem(dataJson) {
    $('#type-request').val('update');
    $('#uuid').val(dataJson.uuid);
    $('#name').val(dataJson.name);
    $('#dob').val(dataJson.dob);
    $('#user_id').val(dataJson.user_id);
    $('#status_id').val(dataJson.status_id);
    if ($('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
}
