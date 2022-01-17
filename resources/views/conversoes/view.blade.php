@extends('layouts.main')

@section('title', 'Converter')

@section('content')

<div id="conversao-create-container" class="col-md-10 offset-md-1">
    <h1>Visualizar</h1>
    
    <table class="table">
      <tbody>
        <tr>
          <th scope="col">#</th>
          <td>{{$conversao->id}}</td>
        </tr>
        <tr>
          <th scope="col">De</th>
          <td>{{$conversao->moedaorigem}}</td>
        </tr>
        <tr>
          <th scope="col">Valor BRL</th>
          <td>{{$conversao->valororigem}}</td>
        </tr>
        <tr>
          <th scope="col">Para</th>
          <td>{{$conversao->moedadestino}}</td>
        </tr>
        <tr>
          <th scope="col">Cotação BRL</th>
          <td>{{$conversao->cotacaoatual}}</td>
        </tr>
        <tr>
          <th scope="col">Forma de pagamento</th>
          <td>{{$conversao->formadepagamento}}</td>
        </tr>
        <tr>
          <th scope="col">Taxa de Pag. (BRL)</th>
          <td>{{$conversao->taxadepagamento}}</td>
        </tr>
        <tr>
          <th scope="col">Taxa de Conv. (BRL)</th>
          <td>{{$conversao->taxadeconversao}}</td>
        </tr>
        <tr>
          <th scope="col">Valor convertido</th>
          <td>{{$conversao->valorconversao}}</td>
        </tr>
        <tr>
          <th scope="col">Data/Hora</th>
          <td>
            @php
            $data = new DateTime($conversao->created_at);
            echo $data->format('d/m/Y H:i:s');
            @endphp
          </td>
        </tr>
        <tr>
          <th scope="col">Ações</th>
          <td>
            <a href="{{url("conversoes/destroy/$conversao->id")}}" class="btn btn-danger" onClick="return confirm('Tem certeza que deseja deletar?');" id="deletar">Deletar</a>
          </td>
        </tr>
      </tbody>
      
    </table>
</div>
@endsection