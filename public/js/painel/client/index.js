var show_path = 'cliente/#UUID#';
var maskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
    onKeyPress: function (val, e, field, options) {
        field.mask(maskBehavior.apply({}, arguments), options);
    }
};

$('#contact').mask(maskBehavior, options);

// TODO: Google Api to Address

async function saveItem() {
    console.log($('#dob').val());
    let dataJson = {
        'name': $('#name').val(),
        'dob': $('#dob').val(),
        'email': $('#email').val(),
        'address': $('#address').val(),
        'contact': $('#contact').val(),
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
    if (!$('#open-insert').hasClass('collapsed')) {
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
    $('#email').val(dataJson.email);
    $('#address').val(dataJson.address);
    $('#contact').val(dataJson.contact);
    $('#user_id').val(dataJson.user_id);
    $('#status_id').val(dataJson.status_id);
    if ($('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
}

