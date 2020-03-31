@extends('layout')

@section('content')

    @php
        $id       = isset( $id )       ? $id       : '';
        $name     = isset( $name )     ? $name     : '';
        $email    = isset( $email )    ? $email    : '';
        $document = isset( $document ) ? $document : '';
        $phone    = isset( $phone )    ? $phone    : '';
        $status   = isset( $status )   ? $status   : '0';
    @endphp

    <form class="form form-horizontal striped-labels form-bordered" id="formCustomer" data-id="{{$id}}" onsubmit="return false">
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
                                <input type="text" id="name" maxlength="100" class="form-control col-md-6" placeholder="Nome completo" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="email">E-mail*</label>
                            <div class="col-md-9">
                                <input type="email" id="email" maxlength="100" class="form-control col-md-6" placeholder="E-mail" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="document">Documento*<br/><small>999.999.999-99</small></label>
                            <div class="col-md-9">
                                <input type="text" id="document" maxlength="100" class="form-control col-md-4" name="document">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="phone">Celular*<br/><small>(99) 9999-9999</small></label>
                            <div class="col-md-9">
                                <input type="text" id="phone" maxlength="100" class="form-control col-md-4" name="phone">
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
        let status      = $('#status');
        let valDocument = $('#document');
        let phone       = $('#phone');
        let formData    = $("form#formCustomer");
        let id          = formData.attr('data-id');
        let methodUrl   = 'post';

        if( id !== '' ){
            methodUrl = 'put';
        }
        $('#name').val('{{$name}}').focus();
        $('#email').val('{{$email}}');
        valDocument.val('{{$document}}');
        phone.val('{{$phone}}');
        status.val('{{$status === false ? '0' : '1'}}');

        formData.validate({
            rules: {
                name: "required",
                email: "required",
                document: "required",
                phone: "required",
            },
            // Specify validation error messages
            messages: {
                name: "Informação obrigatória",
                email: "Informação obrigatória",
                document: "Informação obrigatória",
                phone: "Informação obrigatória",
            },
            submitHandler: function(form) {
                $('button[type="submit"]').html( helper.htmlSpinner() ).attr('disabled',true);

                let formSerialize = formData.serialize();
                formSerialize    += '&status='+ ( status.bootstrapSwitch('state') ? 1 : 0 );

                $.ajax({
                    method: 'POST',
                    url: "/api/"+methodUrl+"/customer/"+id,
                    data: formSerialize,
                    success: function (data, jqXHR) {
                        if(data.messages === 'OK')
                            helper.alertSucess('Ação efetuada com sucesso!');
                        else
                            helper.alertError(data.messages);

                        document.location.href="{{route('customer.index')}}";
                    },
                    error: function(data, jqXHR) {
                        helper.alertError('Ocorreu um erro!')
                    }
                });
            }
        });

        status.bootstrapSwitch();

        valDocument.inputmask({"mask": "999.999.999-99", clearIncomplete: true, showMaskOnFocus: false});
        phone.inputmask({"mask": "(99) 99999-9999", clearIncomplete: true, showMaskOnFocus: false});

    </script>

@endsection
