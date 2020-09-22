@extends('layout')
@section('pagina_titulo', 'Cupons de desconto')

@section('pagina_conteudo')
	<div class="container">
		<div class="row">
			<h3>Lista de cupons de desconto</h3>
			@if (Session::has('admin-mensagem-sucesso'))
	            <div class="card-panel green"><strong>{{ Session::get('admin-mensagem-sucesso') }}<strong></div>
	        @endif
			<table>
				<thead>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Nome</th>
						<th>Localizador</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cupons as $cupom)
					<tr>
						<td>
							<a class="btn-flat tooltipped" href="{{ route('admin.cupons.editar', $cupom->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Editar cupom?">
								<i class="material-icons black-text">mode_edit</i>
							</a>
							<a class="btn-flat tooltipped" href="{{ route('admin.cupons.deletar', $cupom->id) }}" class="btn-flat tooltipped" data-position="right" data-delay="50" data-tooltip="Deletar cupom?">
								<i class="material-icons black-text">delete</i>
								</a>
						</td>
						<td>{{ $cupom->id }}</td>
						<td>{{ $cupom->nome }}</td>
						<td>{{ $cupom->localizador }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row">
			<a class="btn-floating btn-large blue tooltipped" href="{{ route('admin.cupons.adicionar') }}" title="Adicionar" data-position="top" data-delay="50" data-tooltip="Adicionar cupom?">
				<i class="material-icons">add</i>
			</a>
		</div>
	</div>

@endsection