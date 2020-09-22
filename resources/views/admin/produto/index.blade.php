@extends('layout_admin')
@section('pagina_titulo', '| Admin | Produtos')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Produtos</h3>
			@if (Session::has('admin-mensagem-sucesso'))
	            <div class="card-panel green"><strong>{{ Session::get('admin-mensagem-sucesso') }}<strong></div>
	        @endif
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Valor</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($produtos as $produto)
					<tr>
						<td>{{ $produto->id }}</td>
						<td>{{ $produto->nome }}</td>
						<td>R$ {{ $produto->valor }}</td>
						<td>
							<a class="btn-flat tooltipped" href="{{ route('admin.produtos.editar', $produto->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Editar Produto?">
								<i class="material-icons black-text">mode_edit</i>
							</a>
							<a class="btn-flat tooltipped" href="{{ route('admin.produtos.deletar', $produto->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Deletar Produto?">
								<i class="material-icons black-text">delete</i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row">
			<a class="btn-floating btn-large red tooltipped" href="{{ route('admin.produtos.adicionar') }}" title="Adicionar" data-position="top" data-delay="50" data-tooltip="Adicionar Produto?">
				<i class="material-icons">add</i>
			</a>
		</div>
	</div>

@endsection