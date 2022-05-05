@extends('layouts.guest')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <img src="{{asset('imgs/base_logo.png')}}" alt="" class="responsive">
        </div>
    </div>
    <form action="{{route('exchange.results')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="accordion">

                    <div class="collapse show text-center" id="payment_method">
                        <h5>Qual a forma de pagamento?</h5>
                        <div class="spacer mt-3"></div>
                        @foreach ($payment_methods as $payment_method)                            
                            <button data-id="{{$payment_method->id}}" class="btn btn-secondary btn-block btn-legenda" type="button">{{$payment_method->name}}<br><small class="text-center form-text  mt-0 mb-2">Taxa de pagamento de {{$payment_method->tax->value}}%</small></button>    
                        @endforeach                   
                    </div>
    
                    <div class="collapse mt-4 text-center" id="bid_value">
                        <h5>Qual o valor para conversão?</h5>
                        <div class="spacer mt-3"></div>                    
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text">BRL</span>
                            </div>
                            <input type="text" name="ask" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" disabled>Continuar</button>
                            </div>
                          </div>
                          <small class="text-center form-text mt-0 mb-2">Mínimo: {{$min}} BRL - Máximo {{$max}} BRL</small>
                    </div>
    
                    <div class="collapse mt-4 text-center" id="currency">
                        <h5>Qual a moeda de destino?</h5>
                        <div class="spacer mt-3"></div>
                        @foreach ($currencies as $currency)                                                                           
                            <button data-id="{{$currency->id}}" type="button" class="btn btn-secondary btn-sm mt-2 btn-legenda">{{$currency->isocode}}<br><small>{{$currency->name}}</small></button>
                        @endforeach
                    </div>
                    
                    <div class="collapse my-4 text-center" id="buy">                                        
                        <div class="spacer mt-3"></div>                                        
                        <button type="button" class="btn btn-primary">Efetuar cotação</button>                    
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">            
                <h5>Nota aos avaliadores:</h5>
                <ul>
                    <li>Realizar o Seed do banco de dados</li>
                    <li>Concepção de layout <i>Mobile First</i></li>
                    <li>E-mail de cotação via <i>Notifications</i></li>
                    <li>MER do database no arquivo MER.mwb (<i>MySQL Workbench</i>)</li>
                    <li>Carga inicial de moedas em storage/app/currencies.xml<br>(<i>ext-simplexml</i> requerido)</li>
                    <li>Usuário e senha do <i>admin</i> está em Database\Seeders\UsersSeeder</li>
                    <li>Um package foi criado para simular um SDK disponibilizado pela API de Moedas</li>
                    <li>Um Wrapper (App\Libraries\ExchangeRatesService) entre o SDK e o sistema foi criado para facilitar a portabilidade de APIs</li>
                    <li>Não houve tempo hábil para o devido tratamento de erros e filtros em requests</li>
                    <li>Não houve tempo hábil para criação do CRUD para a edição de taxas e meios de pagamento</li>
                </ul>
            </div>
        </div>
        <input type="hidden" name="currency_id">
        <input type="hidden" name="payment_method_id">
    </form>
</div>
@endsection

@push('custom_styles')
    <style>
        .btn-legenda{
            font-weight: bold;
            line-height: 17px;
            padding-top: 10px;
        }
        .btn-legenda > small{
            color: rgba(255, 255, 255, 0.6);
        }
    </style>
@endpush

@push('custom_scripts')
<script>
    function showAccordion(id){
        jQuery('#'+id).collapse('show');
        jQuery('html, body').animate({
            scrollTop: jQuery('#'+id).offset().top-70
        }, 2000);
    }

    function toggleButtons(selector, element){
        jQuery(selector).removeClass('btn-primary').addClass('btn-secondary');
        element.removeClass('btn-secondary').addClass('btn-primary');
    }

    jQuery(document).ready(function(){

        $('input[name="ask"]').mask('00000000.00', {reverse: true});

        $('input[name="ask"]').on('keyup', function(){
            $value = parseFloat($(this).val());            
            if($value >= {{$min}} && $value <= {{$max}}){
                jQuery('#bid_value button').removeAttr('disabled');
            }else{
                jQuery('#bid_value button').prop('disabled',true);
                jQuery('#currency').collapse('hide');
                jQuery('#buy').collapse('hide');
            }
        });

        jQuery('#payment_method > button').click(function(){
            toggleButtons('#payment_method > button', $(this));
            showAccordion('bid_value');
        });

        jQuery('#bid_value button').click(function(){            
            showAccordion('currency');
        });

        jQuery('#currency > button').click(function(){
            toggleButtons('#currency > button', $(this));  
            showAccordion('buy');
        });

        jQuery('#buy > button').click(function(){               
            jQuery('input[name="currency_id"]').val(jQuery('#currency > button.btn-primary').data('id'));
            jQuery('input[name="payment_method_id"]').val(jQuery('#payment_method > button.btn-primary').data('id'));
            jQuery('form').submit();
        });

    });
</script>
@endpush