@extends('layouts.app')
@section('title','Atualizar Produto - '.$produto->titulo)
@section('content',)
	<h1 class="mb-3">Atualizar novo Produto - {{$produto->titulo}}</h1>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
	@endif
	@if(count($errors)>0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<form method="POST" enctype="multipart/form-data" action="{{ route('produtos.update', $produto->id) }}">
		@csrf
		<input type="hidden" name="_method" value ="PATCH">
		<div class="form-group mb-3">
		    <label for="sku">SKU</label>
		    <input type="text" class="form-control" id="sku" name="sku" value="{{$produto->sku}}" placeholder="Digite o Código do Produto..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="titulo">Título</label>
		    <input type="text" class="form-control" id="titulo" name="titulo" value="{{$produto->titulo}}" placeholder="Digite o Nome do Produto..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="descricao">Descrição</label>
		   	<textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma breve descrição do Produto..." required>{{$produto->descricao}}</textarea>
	 	</div>
	 	<label for="preco">Preço</label>
	 	<div class="input-group mb-3">
		    <div class="input-group-prepend">
		    	<span class="input-group-text" id="basic-addon1">R$</span>
			</div>
		    <input type="number" step=".01" class="form-control" id="preco" name="preco" value="{{$produto->preco}}"" placeholder="0,00" required>
	 	</div>
	 	<div class="input-group mb-3">
	 		<label for="imgproduto">Imagem</label>
	 		<input type="file" class="form-control-file" id="imgproduto" name="imgproduto">
	 		
	 	</div>
	 	<button type="submit" class="btn btn-primary">Atualizar</button>
	</form>
@endsection