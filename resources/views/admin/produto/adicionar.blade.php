@extends('layout_admin')
@section('pagina_titulo', '| Admin | Cadastrar Produto')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Cadastrar Produto</h3>
			<form method="POST" action="{{ route('admin.produtos.salvar') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('admin.produto._form')

				<button type="submit" class="btn red">Salvar</button>
			</form>
		</div>
	</div>
	@include('admin.produto._lib')
@endsection