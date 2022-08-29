@component('mail::message')
# Cotação realizada.

<div>
    Olá, <strong style="font-weight: 600">{{ auth()->user()->name }}</strong>!
    <div style="display: block; margin: 20px 0 20px 0"></div>
    Sua cotação de
    <span style="font-weight: 600">{{ $quotation->source_currency_acronym }}</span>
    para
    <span style="font-weight: 600">{{ $quotation->target_currency_acronym }}</span>
    foi realizada com sucesso!
</div>

<hr style="display: block; margin: 20px 0 20px 0" />

<div style="display: flex; flex-direction: column; gap: 8px; font-size: 14px; margin: 16px 0 16px 0">
    <span style="display: block">
        Moeda de origem:
        <strong style="font-weight: 600">
            {{ $quotation->source_currency_acronym }}
        </strong>
    </span>
    <span style="display: block">
        Moeda de destino:
        <strong style="font-weight: 600">
            {{ $quotation->target_currency_acronym }}
        </strong>
    </span>
    <span style="display: block">
        Valor para conversão:
        <strong style="font-weight: 600">
            {{ $quotation->source_currency_symbol . number_format($quotation->source_amount, 2, ',', '.') }}
        </strong>
    </span>
    <span style="display: block">
        Forma de pagamento:
        <strong style="font-weight: 600">
            {{ $quotation->payment_method }}
        </strong>
    </span>
    <span style="display: block">
        Valor utilizado para conversão (moeda de destino):
        <strong style="font-weight: 600">
            {{ $quotation->target_currency_symbol . number_format($quotation->target_currency_quote, 2, ',', '.') }}
        </strong>
    </span>
    <span style="display: block">
        Valor convertido (moeda de destino):
        <strong style="font-weight: 600">
            {{ $quotation->target_currency_symbol . number_format($quotation->target_amount, 2, ',', '.') }}
        </strong>
    </span>
    <span style="display: block">
        Taxa de pagamento:
        <strong style="font-weight: 600">
            {{ $quotation->source_currency_symbol . number_format($quotation->payment_method_fee_amount, 2, ',', '.') }}
        </strong>
    </span>
    <span style="display: block">
        Taxa de conversão:
        <strong style="font-weight: 600">
            {{ $quotation->source_currency_symbol . number_format($quotation->conversion_fee_amount, 2, ',', '.') }}
        </strong>
    </span>    
    <span style="display: block">
        Valor utilizado para conversão (com as taxas):
        <strong style="font-weight: 600">
            {{ $quotation->source_currency_symbol . number_format($quotation->source_taxed_amount, 2, ',', '.') }}
        </strong>
    </span> 
    <span style="display: block">
        Status do pagamento:
        <strong style="font-weight: 600">
            {{ $quotation->payment_status }}
        </strong>
    </span>

</div>


@if ($quotation->payment_status === "Em aberto")
@component('mail::button', ['url' => route('quotations.index')])
    Efetuar pagamento
@endcomponent
@else
@component('mail::button', ['url' => route('quotations.index')])
    Visualizar no sistema
@endcomponent
@endif
@endcomponent
