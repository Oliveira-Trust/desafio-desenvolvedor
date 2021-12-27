@extends('template.template')

@section('title','Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="post" id="formConfig" action="{{route('admin.update', ['id'=>$dados->id]) }}">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label >Taxa de Conversão</label>
                                    <input type="text" class="form-control" id="taxa_conversao" name="taxa_conversao" maxlength="6" value="{{$dados->taxa_conversao}}"  placeholder="R$:">
                                    <small class="form-text text-muted">Informe aqui a taxa de conversão em reais.</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Taxa de Pagamento Boleto</label>
                                            <input type="text" class="form-control" id="taxa_pagamento_boleto" name="taxa_pagamento_boleto" maxlength="6" value="{{$dados->taxa_pagamento_boleto}}" placeholder="R$:">
                                            <small  class="form-text text-muted">Informe aqui a taxa em reais.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Taxa de Pagamento Cartão</label>
                                            <input type="text" class="form-control" id="taxa_pagamento_cartao" name="taxa_pagamento_cartao" value="{{$dados->taxa_pagamento_cartao}}" maxlength="6" placeholder="R$:">
                                            <small class="form-text text-muted">Informe aqui a taxa em reais.</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Gravar</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>

    <script>
        function checkChar(e) {
            var char = String.fromCharCode(e.keyCode);

            var pattern = '[0-9]';
            if (char.match(pattern)) {
                return true;
            }

        }

        $( "#taxa_conversao" ).keypress(function(e) {
            if(!checkChar(e)) {
                e.preventDefault();
            }
        });
        $( "#taxa_pagamento_boleto" ).keypress(function(e) {
            if(!checkChar(e)) {
                e.preventDefault();
            }
        });
        $( "#taxa_pagamento_cartao" ).keypress(function(e) {
            if(!checkChar(e)) {
                e.preventDefault();
            }
        });
    </script>
@endsection
