@extends('layout_admin')
@section('pagina_titulo', '| Admin | Clientes')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Clientes</h3>
			@if (Session::has('admin-mensagem-sucesso'))
	            <div class="card-panel green"><strong>{{ Session::get('admin-mensagem-sucesso') }}<strong></div>
	        @endif
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($clientes as $cliente)
					<tr>
						<td>{{ $cliente->id }}</td>
						<td>{{ $cliente->name }}</td>
						<td>{{ $cliente->email }}</td>
						<td>
							<a class="btn-flat tooltipped" href="{{ route('admin.clientes.editar', $cliente->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Editar Cliente?">
								<i class="material-icons black-text">mode_edit</i>
							</a>
							<a class="btn-flat tooltipped" href="{{ route('admin.clientes.deletar', $cliente->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Deletar Cliente?">
								<i class="material-icons black-text">delete</i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row">
			<a class="btn-floating btn-large red tooltipped" href="{{ route('admin.clientes.adicionar') }}" title="Adicionar" data-position="top" data-delay="50" data-tooltip="Adicionar Cliente?">
				<i class="material-icons">add</i>
			</a>
		</div>
	</div>

@endsection