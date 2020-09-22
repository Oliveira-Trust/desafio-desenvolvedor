@extends('layout')
@section('pagina_titulo', 'Adicionar cupom')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Adicionar cupom</h3>
			<form method="POST" action="{{ route('admin.cupons.salvar') }}">
				{{ csrf_field() }}
				@include('admin.cupom_desconto._form')

				<button type="submit" class="btn blue">Salvar</button>
			</form>
		</div>
	</div>
@endsection