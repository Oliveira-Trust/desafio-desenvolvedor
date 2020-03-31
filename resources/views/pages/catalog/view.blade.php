@extends('layout')

@section('content')

    @php
        $name   = isset( $name )   ? $name   : '';
        $sku    = isset( $sku )    ? $sku    : '';
        $price  = isset( $price )  ? $price  : '';
        $status = isset( $status ) ? $status : '0';
    @endphp

    <form class="form form-horizontal striped-labels form-bordered" id="formCatalog" data-sku="{{$sku}}" onsubmit="return false">
        <div class="card">
            <div class="card-header reload-card">
                <div class="heading-elements">
                    <a data-action="collapse"><i id="icon-filter" class="ft-minus"></i></a>
                    <a data-action="expand"><i class="ft-maximize"></i></a>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="form-body">
                        <h4></h4>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="name">Nome*</label>
                            <div class="col-md-9">
                                <input type="text" id="name" maxlength="100" class="form-control col-md-6" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="sku">SKU*</label>
                            <div class="col-md-9">
                                <input type="text" id="sku" maxlength="100" class="form-control col-md-6" name="sku">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="price">Preço* <small>R$</small></label>
                            <div class="col-md-9">
                                <input type="text" id="price" maxlength="100" class="form-control col-md-4" name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="status">Status*</label>
                            <div class="col-md-9">
                                <input type="checkbox" class="switchBootstrap" id="status" name="status" data-value="{{$status}}"
                                       data-on-text="Sim" data-off-text="Não" data-size="small" data-on-color="success" data-off-color="danger" {{$status ? 'checked' : ''}}/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div id="cardFilter" class="card-content">
                <div class="card-body text-right">
                    <div class="form-actions">
                        <button type="button" onclick="location.href='{{route('customer.index')}}'" class="btn btn-warning btn-click mr-1"><i class="la la-backward"></i> Voltar</button>
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('js')

    <script>
        let status    = $('#status');
        let name      = $('#name');
        let sku       = $('#sku');
        let price     = $('#price');
        let formData  = $("form#formCatalog");
        let id        = formData.attr('data-sku');
        let methodUrl = 'post';

        if( id !== '' ){
            methodUrl = 'put';
        }

        name.val('{{$name}}').focus();
        sku.val('{{$sku}}');
        price.val('{{$price}}');
        status.val('{{$status === false ? '0' : '1'}}');

        formData.validate({
            rules: {
                name: "required",
                sku: "required",
                price: "required"
            },
            // Specify validation error messages
            messages: {
                name: "Informação obrigatória",
                sku: "Informação obrigatória",
                price: "Informação obrigatória"
            },
            submitHandler: function(form) {
                $('button[type="submit"]').html( helper.htmlSpinner() ).attr('disabled',true);

                let formSerialize = formData.serialize();
                formSerialize    += '&status='+ ( status.bootstrapSwitch('state') ? 1 : 0 );

                $.ajax({
                    method: 'POST',
                    url: "/api/"+methodUrl+"/catalog/"+id,
                    data: formSerialize,
                    success: function (data, jqXHR) {
                        if(data.messages === 'OK')
                            helper.alertSucess('Ação efetuada com sucesso!');
                        else
                            helper.alertError(data.messages);

                        document.location.href="{{route('catalog.index')}}";
                    },
                    error: function(data, jqXHR) {
                        helper.alertError('Ocorreu um erro!')
                    }
                });
            }
        });

        $( document ).ready(function() {
            status.bootstrapSwitch();
            price.maskMoney({thousands: '.', decimal: ',', symbolStay: false});

            @if( empty( $sku ) )
            name.on('keyup', function () {
                let scope = $(this);
                sku.val( scope.val().replace(/[^a-zA-Z0-9]/g,"-") );
            });
            @endif

        });

    </script>

@endsection
