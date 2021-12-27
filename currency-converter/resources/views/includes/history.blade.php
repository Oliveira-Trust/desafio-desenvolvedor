@extends('home')

@section('history')
    <div class="card mt-2">
        <div class="card-header"><h3 class="card-title">Histórico</h3></div>
        <div class="card-body">
            @if( isset($quotationData) )
                <div class="col-md-12">
                    <div class="card mt-1">
                        <div class="card-body">

                            @foreach($quotationData as $key => $item)
                                <div class="accordion mt-1" id="">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                Data da cotação: {{$item->created_at->format('Y-m-d H:i')}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <table class="table table-striped table-hover table-sm align-middle">
                                                    <tbody>
                                                    <tr>
                                                        <td>Moeda de origem</td>
                                                        <td><span>BRL</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Moeda de destino</td>
                                                        <td><span>{{$item->destiny_currency}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Valor para conversão</td>
                                                        <td><span>R$ {{$item->value_for_conversion}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Forma de pagamento</td>
                                                        <td><span>{{$item->payment_method}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Valor da "Moeda de destino" usado para conversão</td>
                                                        <td><span>R$ </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Valor comprado em "Moeda de destino"</td>
                                                        <td><span>R$ </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taxa de pagamento</td>
                                                        <td><span>R$ </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taxa de conversão</td>
                                                        <td><span>R$ </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Valor utilizado para conversão descontando as taxas"</td>
                                                        <td><span>R$ </span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
