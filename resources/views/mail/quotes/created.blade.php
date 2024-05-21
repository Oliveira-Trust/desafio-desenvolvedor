<x-mail::message>

    # Cotação Nº: {{ $quote->id }}

    <x-mail::table>
        | Descrição| Valor|
        | ----------------------------- |:---------------------:|
        | Moeda de Origen: | {{ $quote->currency_origin }} - {{ $currencies[$quote->currency_origin] }} |
        | Moeda de destino: | {{ $quote->currency_name }} - {{ $currencies[$quote->currency_name] }} |
        | Data da Cotação: | {{ Carbon\Carbon::parse($quote->created_at)->format('d/m/Y') }} |
        | Método de Pagamento: | {{ $paymentMethods[$quote->payment_method] }} |
        | Valor para {{ $currencies[$quote->currency_name] }}</p> | {{ $quote->currency_value }} |
        | Valor para conversão: | {{ $quote->conversion_amount }} |
        | Taxa de pagamento: | {{ $quote->payment_rate }} |
        | Taxa de conversão: | {{ $quote->conversion_rate }} |
        | Subtotal: | {{ $quote->conversion_value }} |
        | Valor comprado: | {{ $quote->converted_amount }} |
    </x-mail::table>

</x-mail::message>
