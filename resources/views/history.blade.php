@extends('app')

@section('content')

<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Moeda origem</th>
            <th scope="col">Moeda destino</th>
            <th scope="col">Pagamento</th>
            <th scope="col">Valor Origem</th>
            <th scope="col">Valor destino</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cambios as $item)
            <tr>
              <th>{{$item->origin_currency}}</th>
              <td>{{$item->destination_currency}}</td>
              <td>{{$item->payment}}</td>
              <td>{{$item->conversion_value}} {{$item->origin_currency}}</td>
              <td>{{$item->converted_value}} {{$item->destination_currency}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    
</div>

@stop