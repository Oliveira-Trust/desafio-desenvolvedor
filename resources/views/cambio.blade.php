@extends('app')

@section('content')

<div class="container">
    
    <table class="table">
        <thead>
            <tr>
                <th colspan="2" style="text-align: center"><h2>Conversão de valores</h2></th>
            </tr>
    
          <tr>
            <th scope="col">Descrições</th>
            <th scope="col">Valores</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>Moeda de origem:</td>
                <td>{{$operation->origin_currency}}</td>
              </tr>
              <tr>
                <td>Moeda de destino:</td>
                <td>{{$operation->destination_currency}}</td>
              </tr>
              <tr>
                <td>Valor para conversão:</td>
                <td>{{$operation->conversion_value}}</td>
              </tr>
              <tr>
                <td>Forma de pagamento:</td>
                <td>{{$operation->payment}}</td>
              </tr>
              <tr>
                <td>Valor da "Moeda de destino" usado para conversão:</td>
                <td>{{$operation->value_purchase_currency_destination}}</td>
              </tr>
              <tr>
                <td>Valor comprado em "Moeda de destino":</td>
                <td>{{$operation->converted_value}}</td>
              </tr>
              <tr>
                <td>Taxa de pagamento:</td>
                <td>{{$operation->payment_rate}}</td>
              </tr>
              <tr>
                <td>Taxa de conversão:</td>
                <td>{{$operation->conversion_rate}}</td>
              </tr>
              <tr>
                <td>Valor utilizado para conversão descontando as taxas:</td>
                <td>{{$operation->purchase_value}}</td>
              </tr>

            </tbody>
      </table>
    
</div>

@stop