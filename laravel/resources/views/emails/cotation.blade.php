<x-mail::message>
    <h1>Olá, {{ $data['name'] }}!</h1>
    <p>Segue os dados da sua cotação</p>
    <blockquote>
        <p> Moeda de origem:<strong>{{$data['currency_origin']}}</strong></p>
        <p> Moeda de destino:<strong>{{$data['currency_buy']}}</strong></p>
        <p> Valor para Conversão:<strong>@money($data['amount'])</strong></p>
        <p> Forma de pagamento:<strong>{{$data['payment_type']}}</strong></p>
        <p> Valor da "Moeda de destino" usado para conversão:<strong>@money($data['currency_value'])</strong></p>
        <p> Valor comprado em "Moeda de destino":<strong>@money($data['value_bought'])</strong></p>
        <p> Taxa de pagamento: <strong>@money($data['payment_tax'])</strong></p>
        <p> Taxa de conversão: <strong>@money($data['conversion_tax'])</strong></p>
        <p> Valor utilizado para conversão descontando as taxas:<strong>@money($data['conversion_value'])</strong></p>
    </blockquote>
    Saudações,<br>
    {{ config('app.name') }}
</x-mail::message>
