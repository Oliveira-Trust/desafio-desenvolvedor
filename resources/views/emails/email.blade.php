@component('mail::message')
Conversão feita

<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-12">
            <table class="table table-striped">
                <tr>
                    <th>Valor para conversão</th>
                    <th>Moeda origem</th>
                    <th>Moeda destino </th>
                    <th>Valor com descontos</th>
                    <th>Forma de pagamento</th>
                    <th>Valor convertido</th>
                </tr>
                <tr>
                    <td>{{ number_format( $details->value, 2, ',', '.' ) }}</td>
                    <td>{{ $details->origin_coin }}</td>
                    <td>{{ $details->destination_coin }}</td>
                    <td>{{ number_format( $details->value_with_discount, 2, ',', '.' ) }}</td>
                    <td>{{ $details->payment_method }}</td>
                    <td>{{ number_format( $details->value_buy, 2, ',', '.' ) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@component('mail::button', ['url' => 'http://localhost:8000/'])
    Voltar para o sistema
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
