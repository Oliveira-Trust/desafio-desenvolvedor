@extends('layouts.main')

@section('title', 'Converter')

@section('content')


<div id="conversao-create-container" class="col-md-10 offset-md-1">
    <h1>Converter </h1>
    <form action="{{url('conversoes')}}" id="formConversao" name="formConversao" method="POST">
        @csrf
        <div class="form-group">
            <label for="moedaorigem">Moeda de origem:</label>
            <input  type="text" id="moedaorigem" class="form-control" name="moedaorigem" value="BRL" readonly="">
        </div>
        <div class="form-group">
            <label  for="valororigem">Valor de origem (BRL):</label>
            <input type="number" id="valororigem" class="form-control" name="valororigem" step="0.01" min="1000" max="100000" placeholder="Ex: 10000" required="">
        </div>
        <div class="form-group">
            <label for="moedadestino">Moeda de destino:</label>
            <select class="form-control" id="moedadestino" name="moedadestino" required="">
                <option value="">-- Selecione --</option>
                @foreach ($conversao->getMoedas() as $moeda => $desc)
                <option value="{{$moeda}}">{{$desc['descricao']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cotacaoatual">Cotação atual (BRL):</label>
            <input  type="text" id="cotacaoatual" class="form-control" name="cotacaoatual"  readonly="" required="">
        </div>
        <div class="form-group">
            <label for="formadepagamento">Forma de pagamento:</label>
            <select id="formadepagamento"  class="form-control" name="formadepagamento" required="">
                <option value="">-- Selecione --</option>
                @foreach ($conversao->getFormaPagamento() as $formaPag)
                <option value="{{$formaPag}}">{{$formaPag}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="taxadepagamento">Valor da taxa de pagamento (BRL):</label>
            <input type="text" id="taxadepagamento" class="form-control" name="taxadepagamento"  readonly="" required="">
        </div>
        <div class="form-group">
            <label for="taxadeconversao">Valor da taxa de conversão (BRL):</label>
            <input type="text" id="taxadeconversao" class="form-control" name="taxadeconversao"  readonly="" required="">
        </div>
        <div class="form-group">
            <label for="valorconversao">Valorda da conversão:</label>
            <input type="text" class="form-control" id="valorconversao"  name="valorconversao"  readonly="" required="">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" value="Confirmar">
    </form>
</div>
@endsection