
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var products = [];
    var precoCalculado = 0;
    $(".table-responsive").on('click','#btnAddCart',function()
    {
        var row = $(this).closest("tr");    // Find the row
        var productId = row.find(".productId").val(); // Find the productID
        var productPrice = row.find(".productPrice").html(); // Find the productprice
        var nameProduct = row.find(".productName").html(); // Find the productname
        var productQuantity = row.find(".productQuantity").val(); // Find the orderQuantity
        var selectClient = row.find("#selectClient").val(); // Find the selectClient
        var statusOrder = row.find("#statusOrder").val(); // Find the selectClient

        if(!productQuantity || productQuantity == 0){
            alert('Produto não pode ser adicionado com quantidade vazia.');
            return false;
        }

        if(!selectClient || selectClient == 0){
            alert('Produto não pode ser cliente');
            return false;
        }
        products[productId] = {
            "productId":productId,
            "productQuantity" : productQuantity,
            "selectClient" : selectClient,
            "statusOrder":statusOrder
        };


        $(".card").show();
        $('.card-body').append('<div class="alert alert-success" role="alert">\n' +
            '  <p class="mb-0">' + nameProduct + '<div class="text-right"><button class="btn btn-danger btn-remove" data_id="'+productId+'"><i class="fas fa-minus-circle"></i></button></div></p>\n' +
            '</div>');

        productPrice = parseFloat(productPrice) * parseInt(productQuantity);
        precoCalculado = parseFloat(precoCalculado) + parseFloat(productPrice);

        $('.card-footer').html('Valor do Pedido em Reais: R$' + precoCalculado);
        $(this).parents('tr').hide();
    });

    $('body').on('click', '.btn-remove', function(){
        $productId = $(this).attr('data_id');
        $.each(products, function(index, product){
            if (typeof product !== "undefined") {
                if (index == $productId) {
                    products.splice(index);
                }
            }

        });
        $('table').find('tbody').find('tr').hide();
        $('table').find('tbody').find('tr').each(function(){
            if (Object.keys(products).indexOf($(this).find('.productId').val()) == -1) {
                $(this).show();
            }
        });
        $(this).parents('.alert').remove();
        return false;
    });


});
