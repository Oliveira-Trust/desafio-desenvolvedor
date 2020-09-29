@extends('layouts.app')
@section('title','Carrinho')
@section('content',)

@if(Session::has('carrinho'))
<div class="row">
	<div class="col-sm-16 col-md-6 col-md-offset-3 col-sm-offset-3">
		<ul class="list-group">
			@foreach($produtos as $produto)
			<li class="list-group-item">
				<span class="badge">{{$produto['qtd']}}</span>
				<strong>{{$produto['item']['titulo']}}</strong>
				<span class="label label-success">R$: {{$produto['preco']}}</span>
				<div class="btn-group">
					
						<a href="{{URL::to('ex-carrinho')}}/{{$produto['item']['id']}}">  Excluir</a>
						
				</div>
			</li>	
			@endforeach
		</ul>
	</div>
	<div class="row">
		<div class="col-sm-16 col-md-6 col-md-offset-3 col-sm-offset-3">
			<strong>Total: {{$precototal}}</strong>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-16 col-md-6 col-md-offset-3 col-sm-offset-3">
			<a href="{{url('checkout')}}" type="button" class="btn btn-success">Checkout</a>
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-sm-16 col-md-6 col-md-offset-3 col-sm-offset-3">
		<h2>Nenhum item no carrinho;</h2>
	</div>
</div>
@endif
@endsection