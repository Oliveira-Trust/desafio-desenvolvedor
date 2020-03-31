@extends('layout')

@section('css')
    <style>
        .border tr th, .border tr td{border: 1px solid #e3ebf3 !important;}
        .ui-autocomplete-input{font-size: 1.8rem;}
        .prod-qty{font-size: 1.3rem;}
        .amount-value {font-weight: bold;font-size: 26px;color: white;}
    </style>
@endsection

@section('content')
    <form class="form form-horizontal striped-labels form-bordered" id="formData" data-reload="{{route('order.index')}}" onsubmit="return false">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="initials">Cliente*</label>
                        <div class="col-md-9">
                            <select id="customer" class="form-control">
                                <option value="">--</option>
                                @foreach($customers as $row)
                                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="initials">Produtos*</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group search">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ft-search"></i></span></div>
                                        <input type="text" class="form-control ac-remote-datasource ui-autocomplete-input" placeholder="Digite nome de um produto" autocomplete="off">
                                    </div>
                                    <div><small class="search-error search-error text-danger font-weight-bold"></small></div>
                                </div>

                                <table class="table table-hover table-striped table-de border table-products border m-1">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Produto</th>
                                        <th class="border-top-0">Preço</th>
                                        <th class="border-top-0">Quantidade</th>
                                    </tr>
                                    </thead>
                                    <tbody class="product-list">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="initials">Desconto* <small>em %</small></label>
                        <div class="col-md-9">
                            <input type="number" class="form-control col-xl-1 col-lg-2 col-md-3" id="discount" min="0" max="100" value="0">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div id="cardFilter" class="card-content">
                <div class="card-body text-right">
                    <div class="pull-left">
                        <h2 class="text-info font-weight-bold">TOTAL <span data-pay="0" class="amount-value badge badge-info">R$ 0,00</span></h2>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Criar pedido</button>
                    </div>
                </div>
            </div>

        </div>

    </form>
@endsection

@section('js')
    <script>

        $( document ).ready(function() {

            $('.btn-primary').on('click', function () {
                let scope      = $(this);
                let htmlBtn    = scope.html();
                let elems      = $('input.prod-qty');
                let elemForm   = $('#formData');
                let customerID = $('select#customer').val();

                if( customerID === '' ) {helper.alertError('Cliente não selecionado');return false;}

                if( elems.length > 0 ) {

                    scope.attr('disabled', true).html(helper.htmlSpinner());

                    let dataSend = {
                        customer_id : customerID,
                        final_price: getAmount(),
                        items: [],
                    };

                    scope.attr('disabled', true).html( helper.htmlSpinner() );

                    let scopeElem = null;
                    $.each( elems, function (index, elem) {
                        scopeElem = $( elem );
                        dataSend.items.push( { catalog_id: scopeElem.attr('data-id'), qty: scopeElem.val() } );
                    } ) ;

                    //console.log( dataSend );return false;

                    $.ajax({
                        type: 'POST',
                        timeout: 10000,
                        data: dataSend,
                        url: "/api/post/order/",
                        success: function (data, jqXHR) {
                            helper.alertSucess('Ficha registrada com sucesso', false, 2);
                            window.location.href = elemForm.attr('data-reload');
                        },
                        error: function (data, jqXHR) {
                            scope.attr('disabled', false).html(htmlBtn);
                            helper.alertError(data.responseJSON.messages);
                        }
                    });

                } else {
                    helper.alertError('Lista de insumos vazia');
                }

            });

            // Remote Datasource
            let cache      = {};
            let elemSearch = $(".ac-remote-datasource");
            elemSearch.autocomplete({
                source: function(request, response) {

                    let term = request.term;

                    if (term in cache) {
                        window.setTimeout(function(){
                            elemSearch.removeClass('ui-autocomplete-loading');
                            response(cache[term]);
                        }, 150);
                        return;
                    }

                    $('.search-error').html('');

                    $.ajax({
                        url: "/api/get/catalog/avaible",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            let array = data.error ? [] : $.map(data, function(m) {
                                // SE MUDAR AQUI, MUDE TB NO METODO startEdit()
                                return {
                                    label: m.id+' - '+m.name,
                                    value: m.id,
                                    price: m.price,
                                    name: m.name,
                                    qty: 1,
                                };
                            });
                            elemSearch.removeClass('ui-autocomplete-loading');
                            cache[term] = array;
                            response(array);
                        },
                        error: function (data, xhr, ajaxOptions, thrownError) {
                            elemSearch.removeClass('ui-autocomplete-loading');
                            $('.search-error').html(data.responseJSON.messages);
                        }
                    });

                },
                minLength: 2,
                highlight: true,
                select: function (event, ui) {
                    addProduct( ui.item );
                    $( event.target ).val('');
                    return false;
                },
                change: function () {
                    $('.search-error').html('');
                },
                close : function(event)
                {

                }
            });

            function getAmount() {
                let amount  = 0;
                let discount = parseInt( $('#discount').val() );
                $.each( $('.product-list tr') , function (index, element) {
                    element    = $(element);
                    let price  = parseFloat( element.find('td.price').attr('data-price') );
                    let qty    = parseInt( element.find('input.prod-qty').val() );
                    amount += ( qty * price );
                } );

                if( discount > 0 ){
                    amount = amount - ( amount * ( discount / 100 ) );
                }

                return amount;
            }
            
            function updateAmount() {
                let element = $('.amount-value');

                element.html('R$ ' + helper.numberFormat( getAmount(), 2 ) );
            }

            function addProduct( item ) {
                let price = helper.formatInputValToFloat( item.price );
                $('.product-list').append('<tr class="line">\n' +
                    '    <td class="td-line name">'+item.name+'</td>\n' +
                    '    <td class="td-line price" data-price="'+price+'">R$ '+item.price+'</td>\n' +
                    '    <td class="td-line qtd">\n' +
                    '        <div class="input-group border-0">\n' +
                    '            <input type="number" class="form-control prod-qty" data-id="'+item.value+'" data-price="'+price+'" min="1" value="'+item.qty+'">\n' +
                    '            <span class="input-group-append">\n' +
                    '                <button class="btn btn-delete btn-danger" type="button"><i class="ft-x"></i></button>\n' +
                    '            </span>\n' +
                    '        </div>\n' +
                    '    </td>\n' +
                    '</tr>');

                updateAmount();

                $('input.prod-qty, #discount').off().on('change', function () {
                    updateAmount();
                });

                $('.btn-delete').off().on('click', function () {
                    let scope = $( this );
                    swal({
                        title: 'Atenção!',
                        html: 'Deseja realmente excluir esse item?',
                        type: "warning",
                        confirmButtonText: "SIM",
                        cancelButtonText: "NÃO",
                        width: '462px',
                        showCancelButton: true
                    }).then((dismiss) => {
                        if (dismiss.value) {
                            scope.parent().parent().parent().parent().remove();
                            updateAmount();
                        }
                    });

                });
            }

        });
    </script>
@endsection
