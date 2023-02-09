@extends('layouts.app')

@section('content')
    <div class="div-center p-5-bottom">
        <h6>Siglas</h6>
    </div>
    <div class="div-center">
        <h6>MD: Moeda de Destino</h6>
    </div>
    <div class="div-center p-5-bottom">
        <h6>CDT: conversão descontando as taxas</h6>
    </div>

    <div class="accordion" id="accordionExample">
        @forelse ($data as $item)
        
        @php($cipher = '')
        
        @if ($item->destination_currency == 'USD')
           @php($cipher = '$') 
        @endif
        @if ($item->destination_currency == 'EUR')
           @php($cipher = '€') 
        @endif

            <div class="accordion-item p-20">
                <h2 class="accordion-header" id="heading-{{ $item->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne">
                        Cotação - {{ $item->created_at->format('d/m/Y H:i:s') }}
                    </button>
                </h2>
                <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse"
                    aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-lg-4 text-center">
                                <p>Moeda de origem: <b>{{ $item->origin_currency }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Moeda de destino: <b>{{ $item->destination_currency }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Valor para conversão: <b>R$ {{ $item->value_conversation }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Forma de pagamento: <b>{{ $item->form_payment }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Valor da "MD" usado para conversão: <b>{{$cipher}} {{$item->dest_currency_conv }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Valor comprado em "MD": <b>{{$cipher}} {{$item->purchased_amount_in }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Taxa de pagamento: <b>R$ {{ $item->pay_rate }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Taxa de conversão: <b>R$ {{ $item->conversion_rate }}</b></p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p>Valor utilizado para CDT: <b>R$ {{ $item->amount_used_conv }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="div-center p-5-bottom color-text-empty">
                <h4>Nenhum Histórico de Cotação</h4>
            </div>
        @endforelse
    </div>
    <div class="div-center p-20">
        {!! $data->links() !!}
    </div>
@endsection
