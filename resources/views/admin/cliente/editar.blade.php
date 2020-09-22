@extends('layout_admin')
@section('pagina_titulo', '| Admin | Editar Cliente')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Editar Cliente "{{ $registro->name }}"</h3>
			<form method="POST" action="{{ route('admin.clientes.atualizar', $registro->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				@include('admin.cliente._form')

				<button type="submit" class="btn red">Atualizar</button>
			</form>
		</div>
	</div>
@endsection