var show_path = 'produto/#UUID#';

// TODO: Google Api to Address and phone validation

$('#price').mask("#.##0,00", {
    reverse: true
});

async function saveItem() {
    let dataJson = {
        'name': $('#name').val(),
        'description': $('#description').val(),
        'price': formatMoneyToDB($('#price').val()),
        'image': $('#image').val(),
        'user_id': $('#user_id').val(),
        'status_id': $('#status_id').val()
    }
    console.log(dataJson);
    if ($('#type-request').val() == 'new') {
        sendItem('produto', dataJson);
        return;
    }
    dataJson.uuid = $('#uuid').val();
    sendItem('produto/' + dataJson.uuid, dataJson, 'PUT');
    return;
}

async function sendItem(url, dataJson, type = 'POST') {
    let httpCall = await postData(url, dataJson, type);
    if (!$('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
    $('.buttons-reload').click();
    clearForm('#product-create');
}

async function fillItem(dataJson) {
    let resolveImage = dataJson.image.replace($('meta[name="site-url"]').attr('content') + '/', '');
    console.log(resolveImage);
    $('#type-request').val('update');
    $('#uuid').val(dataJson.uuid);
    $('#name').val(dataJson.name);
    $('#description').val(dataJson.description);
    $('#price').val(formatMoneyBr(dataJson.price, false));
    $('#image').val(resolveImage);
    $('#user_id').val(dataJson.user_id);
    $('#status_id').val(dataJson.status_id);
    if ($('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
}
