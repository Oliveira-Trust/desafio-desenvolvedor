const { data } = require("jquery");

jQuery(function() {
    restart();
    $("#add-product").on("click", function (event) {
        addProduct(event);
    });

    function verifyProduct(product) {
        while ($(`select[name="product_id[${product}]"]`).length > 0) {
            product++;
        }
        return product;
    }

    function addProduct(event) {
        event.preventDefault();
        var product = verifyProduct($('.product_id').length);
        var options = $('#product_id').html().replace('selected="selected"', '');

        var content = ` <div class="form-group row event-group${product}">
                            <div class="col-md-5">
                                <label for="product_id[${product}]">Product</label>
                                <select class="product form-control select2" product-id="${product}" name="product_id[${product}]">
                                ${options}
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="amount[${product}]">Amount</label>
                                <input product-id="${product}" class="amount form-control " name="amount[${product}]" type="number">
                            </div>
                            <div class="col-md-2">
                                <label for="unit_price[${product}]">Unit Price</label>
                                <input class="form-control" readonly name="unit_price[${product}]" type="text" id="unit_price[${product}]">
                            </div>
                            <div class="col-md-2">
                                <label for="total_price[${product}]">Total Price</label>
                                <input class="form-control total-price" name="total_price[${product}]" type="text" readonly>
                            </div>

                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <a href="#" event-group="${product}" class="remove">
                                    <i class="fas fa-minus-circle fa-lg"></i>
                                </a>
                            </div>
                        </div>`;

        $("#products").append(content);
        restart();
        $(".remove").on("click", function (event) {
            removeProduct(event, this);
        });
    }

    $(".remove").on("click", function (event) {
        removeProduct(event, this);
    });
});

function removeProduct(event, click){
    event.preventDefault();
    let eventGroup = $(click).attr('event-group');
    let deleteId = $(click).attr('delete-id');
    $(`.event-group${eventGroup}`).remove();
    if(deleteId){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '/order/product/' + deleteId,
            dataType: 'json',
            success: function (msg) {}
        });
    }
    sumTotal();
}

function restart(){
    $('.select2').select2({
        theme: 'bootstrap4',
    });

    $('.product').on('change', function(){
        let productId = $(this).attr('product-id');
        sumTotal();
        $.ajax({
            type: 'get',
            url: '/product/show/' + $(this).val(),
            dataType: 'json',
            data: data,
            beforeSend: function () {
                $(`input[name="unit_price[${productId}]"]`).val('Aguarde...');
            },
            success: function (data) {
                $(`input[name="amount[${productId}]"]`).attr('max', data.stock);
                $(`input[name="unit_price[${productId}]"]`).val(data.price);

            }
        });
    });

    $('.amount').on('keyup', function(){
        let productId = $(this).attr('product-id');
        let totalPrice = $(`input[name="unit_price[${productId}]"]`).val().replace(',', '.') * $(this).val();
        $(`input[name="total_price[${productId}]"]`).val(String(parseFloat(totalPrice.toFixed(2))).replace('.', ','));
        sumTotal();
    });
}

function sumTotal()
{
    $(`#order_total_price`).val('0.00');
    $(".total-price").each(function () {
        let value = 0.00;
        let screen = parseFloat($(`#order_total_price`).val().replace(',', '.'));
        if ($(this).val() != '') {
            value = parseFloat($(this).val().replace(',', '.'));
        }
        $(`#order_total_price`).val(String((screen + value).toFixed(2)).replace('.', ','));
    });
}

