@extends('app')

@section('content')
  <div class="container">
    <form method="POST" action="{{route('settings')}}">
      @csrf

      @foreach ($settings as $item)
          
        <div class="form-group">
          <label for="exampleInputEmail1">Taxa Boleto</label>
          <input type="number" step="0.01" name="boleto" value="{{$item->boleto}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Taxa Credito</label>
          <input type="number" step="0.01" class="form-control" value="{{$item->credito}}"  name="credito" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Taxa Cambio < 3000</label>
          <input type="number" step="0.01" class="form-control" name="conversaomenor" value="{{$item->conversaomenor}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Taxa Cambio > 3000</label>
          <input type="number" step="0.01" class="form-control" name="conversaomaior" value="{{$item->conversaomaior}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
      @endforeach

    <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
  </div>
@stop