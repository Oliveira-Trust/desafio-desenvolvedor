var show_path = 'ordens/#UUID#';

// TODO: Google Api to Address and phone validation

$('#price').mask("#.##0,00", {
    reverse: true
});

function addProduct(aProducts = false) {
    if (aProducts) {
        $('#products-list').html('');
        $.each(aProducts, function (index, object) {
            $('#products-list').append('<li class="product-item list-group-item d-flex justify-content-between align-items-center" data-id="' + object.product_id + '" data-price="' + object.price + '" data-qnt="' + object.qnt + '"><p>' + object.qnt + 'x ' + object.product.name + '<br />' + formatMoneyBr(object.qnt * object.price) + '</p><img class="float-right" src="' + object.product.image + '" height="120px"><span onclick="$(\'.product-item[data-id=' + object.product_id + ']\').remove();" class="badge badge-primary badge-pill">&times;</span></li>');
        });
        return;
    }
    let qnt = $('#products-qnt').val();
    let productId = $('#products option:selected').val();
    let productName = $('#products option:selected').text();
    let productPrice = $('#products option:selected').attr('data-price');
    let productImg = $('#products option:selected').attr('data-img');
    $('#products-list').append('<li class="product-item list-group-item d-flex justify-content-between align-items-center" data-id="' + productId + '" data-price="' + productPrice + '" data-qnt="' + qnt + '"><p>' + qnt + 'x ' + productName + '<br />' + formatMoneyBr(qnt * productPrice) + '</p><img class="float-right" src="' + productImg + '" height="120px"><span onclick="$(\'.product-item[data-id=' + productId + ']\').remove();" class="badge badge-primary badge-pill">&times;</span></li>');
    return;
}

function getAllProducts() {
    let productsList = [];
    $('.product-item').each(function (index, element) {
        productsList.push({
            'qnt': $(element).attr('data-qnt'),
            'price': $(element).attr('data-price'),
            'product_id': $(element).attr('data-id'),
        });
    });
    return productsList;
}

async function getTotal(uuid) {
    let httpCall = await getData('ordens/' + uuid);
    let response = resolveResult(httpCall);
    let contador = 0;
    $.each(response.products, function (index, object) {
        contador += object.price;
    });
    return formatMoneyBr(contador);
}

async function saveItem() {
    let dataJson = {
        'client_id': $('#client_id').val(),
        'user_id': $('#user_id').val(),
        'status_id': $('#status_id').val(),
        'products': getAllProducts()
    }
    if ($('#type-request').val() == 'new') {
        sendItem('ordens', dataJson);
        return;
    }
    dataJson.uuid = $('#uuid').val();
    sendItem('ordens/' + dataJson.uuid, dataJson, 'PUT');
    return;
}

async function sendItem(url, dataJson, type = 'POST') {
    let httpCall = await postData(url, dataJson, type);
    if (!$('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
    $('.buttons-reload').click();
    $('#products-list').html('');
    clearForm('#order-create');
}

async function fillItem(dataJson) {
    $('#type-request').val('update');
    $('#uuid').val(dataJson.uuid);
    $('#client_id').val(dataJson.client_id);
    $('#user_id').val(dataJson.user_id);
    $('#status_id').val(dataJson.status_id);
    addProduct(dataJson.products);
    if ($('#open-insert').hasClass('collapsed')) {
        $('#open-insert').click();
    }
}
