@extends('layout_admin')
@section('pagina_titulo', '| Admin | Cadastrar Cliente')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Cadastrar Cliente</h3>
			<form method="POST" action="{{ route('admin.clientes.salvar') }}">
				{{ csrf_field() }}
				@include('admin.cliente._form')

				<button type="submit" class="btn red">Salvar</button>
			</form>
		</div>
	</div>
@endsection