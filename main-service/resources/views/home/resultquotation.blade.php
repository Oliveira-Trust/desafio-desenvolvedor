@extends('layout.site')

@section('title','Home')

@section('conteudo')
<!-- page content -->
<div class="right_col" role="main">
    <!-- CONTENT -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title_left">
            <h3>Cotações <small></small></h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Resultado da Cotação <small> </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div><br/>
                <!-- Mensagens validação -->
                <ul>
                    <li>Moeda de origem: {{$result['from_currency']}}</li>
                    <li>Moeda de destino: {{$result['to_currency']}}</li>
                    <li>Valor para conversão: R$ {{ $result['amount'] }}</li>
                    <li>Forma de pagamento: {{$result['payment_method']}}</li>
                    <li>Taxa de pagamento: R$ {{ $result['payment_fee'] }}</li>
                    <li>Taxa de conversão: R$ {{ $result['conversion_fee'] }}</li>
                    <li>Valor utilizado para conversão descontando as taxas*: R$ {{ $result['new_amount'] }}</li>
                    <li>Valor da cotação usado para conversão: R$ {{ $result['quotation'] }}</li>
                    <li>Valor final em <b> {{$result['to_currency']}}: {{ $result['amount_converted'] }} </b></li>
                </ul>
                <p>
                    Esta cotação foi enviada para seu email.
                </p>
                * Taxas aplicadas no valor de compra diminuindo no valor total de conversão.
                <div class="clearfix"></div><br>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="form-group">
                                <div align="center" >
                                    <a href="{{ URL::asset('index') }}" class="btn btn-success">Solicitar Nova Cotação</a>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div> <!-- END-CONTENT -->
</div>
<!-- /page content -->
@endsection
