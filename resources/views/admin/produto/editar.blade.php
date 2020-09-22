@extends('layout_admin')
@section('pagina_titulo', '| Admin | Editar Produto')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Editar Produto "{{ $registro->nome }}"</h3>
			<form method="POST" action="{{ route('admin.produtos.atualizar', $registro->id) }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				@include('admin.produto._form')

				<button type="submit" class="btn red">Atualizar</button>
			</form>
		</div>
	</div>
	@include('admin.produto._lib')
@endsection