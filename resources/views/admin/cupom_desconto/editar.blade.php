@extends('layout')
@section('pagina_titulo', 'Editar cupom')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Editar cupom "{{ $registro->nome }}"</h3>
			<form method="POST" action="{{ route('admin.cupons.atualizar', $registro->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				@include('admin.cupom_desconto._form')

				<button type="submit" class="btn blue">Atualizar</button>
			</form>
		</div>
	</div>
@endsection