@extends('layouts.main')

@section('title', 'Converter')

@section('content')

<div class="col-md-10 m-auto">
    <h2>Histórico de Conversões</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">De</th>
          <th scope="col">Valor BRL</th>
          <th scope="col">Para</th>
          <th scope="col">Cotação BRL</th>
          <th scope="col">Forma de pagamento</th>
          <th scope="col">Taxa de Pag.</th>
          <th scope="col">Taxa de Conv.</th>
          <th scope="col">Valor convertido</th>
          <th scope="col">Data/Hora</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($listaConversoes as $lista) 
        <tr>
          <th scope="row">{{$lista->id}}</th>
          <td>{{$lista->moedaorigem}}</td>
          <td>{{$lista->valororigem}}</td>
          <td>{{$lista->moedadestino}}</td>
          <td>{{$lista->cotacaoatual}}</td>
          <td>{{$lista->formadepagamento}}</td>
          <td>{{$lista->taxadepagamento}}</td>
          <td>{{$lista->taxadeconversao}}</td>
          <td>{{$lista->valorconversao}}</td>
          <td>
              @php
              $data = new DateTime($lista->created_at);
              echo $data->format('d/m/Y H:i:s');
              @endphp
          </td>
          <td>
              <a href="{{url("conversoes/$lista->id")}}" class="btn btn-success" id="visualizar">Visualizar</a>
              <a href="{{url("conversoes/destroy/$lista->id")}}" class="btn btn-danger" onClick="return confirm('Tem certeza que deseja deletar?');" id="deletar">Deletar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

@endsection