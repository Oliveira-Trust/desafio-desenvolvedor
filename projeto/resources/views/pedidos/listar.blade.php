<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">

		<script src="/js/BaseRequest.js"></script>
		<script src="/js/BaseDataTables.js"></script>

		<!-- Ícones -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		
		<title>Listar pedidos</title>
	
    </head>
    <body>
	
		@include('menu')
		
		<div class="container">
		
			<div class="row">
				<div class="col-sm-12">
					
					<button id="remover" class="btn btn-danger float-left">
						<i class="fa fa-trash" aria-hidden="true"></i>Remover selecionados
					</button>
					
					<a id="criar" class="btn btn-primary float-right" href="/pedidos/criar" title="Criar pedido">
						<i class="fa fa-plus" aria-hidden="true"></i>Adicionar
					</a>
					
				</div>
			</div>
	
			<div class="col-sm-12">
				<table id="pedidos" class="display">
					<thead>
						<tr>
							<th>Id</th>
							<th>Status</th>
							<th>Cliente</th>
							<th>Criado em</th>
							<th>Atualizado em</th>
							<th>Total (R$)</th>
							<th></th><!-- Ver mais -->
							<th></th><!-- Editar -->
							<th></th><!-- Excluir -->
						</tr>
					</thead>
					<tbody>
						@foreach ($pedidos as $pedido)
							<tr>
								<td class="selecionavel">{{ $pedido->id }}</td>
								<td class="selecionavel">{{ $pedido->status }}</td>
								<td class="selecionavel">{{ $pedido->cliente->nome }}</td>
								<td class="selecionavel">{{ $pedido->data_criacao_str }}</td>
								<td class="selecionavel">{{ $pedido->data_atualizacao_str }}</td>
								<td class="selecionavel">{{ number_format(floatval($pedido->total), 2, ",", "") }}</td>
								<td class="icone"><a href="/pedidos/ver/{{ $pedido->id }}" title="Ver mais">
									<i class="fa fa-eye" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/pedidos/alterar/{{ $pedido->id }}" title="Alterar">
									<i class="fa fa-pencil" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/pedidos/remover/{{ $pedido->id }}" title="Remover">
									<i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
					
					
					<tfoot>
						<tr>
							<th><input class="tfoot-search" type="text"></th>
							<th><input class="tfoot-search" type="text"></th>
							<th><input class="tfoot-search" type="text"></th>
							<th><input class="tfoot-search" type="text"></th>
							<th><input class="tfoot-search" type="text"></th>
							<th><input class="tfoot-search" type="text"></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
					
				</table>
			</div>
		</div>
	
	
		<!-- DataTables para listagem e filtragem (JQuery está incluso em app.js). -->
		<script src="/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
		
		
		<script>
			$(document).ready (function () {
				
				// Criação da tabela:
				let config = {
					columns: [
						{ orderable: true }, 	// id
						{ orderable: true }, 	// status
						{ orderable: true }, 	// cliente
						{ orderable: true }, 	// data de criação
						{ orderable: true }, 	// data de atualização
						{ orderable: true }, 	// total
						{ orderable: false }, 	// ver mais
						{ orderable: false }, 	// alterar
						{ orderable: false } 	// remover
					],
					columnDefs: [
						{
							// Rendering da data no padrão brasileiro.
							targets: [3, 4],
							render: $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'DD/MM/YYYY HH:mm:ss')
						},
						{ responsivePriority: 1, targets: 0 },	// id
						{ responsivePriority: 9, targets: -3 },	// ver mais
						{ responsivePriority: 9, targets: -2 }, // alterar
						{ responsivePriority: 9, targets: -1 }	// remover
					],
					responsive: true
				};
				$.extend(config, DT_DEFAULT_OPTIONS);
				let tabela_pedidos = $('#pedidos').DataTable(config);
				
				
				// Filtragem:
				campoPesquisaRodape('pedidos', tabela_pedidos);
				
				
				// Manipulação dos itens em massa:
				adicionarClasseSelecionavel('pedidos');
				exclusaoItensMassa(tabela_pedidos, 0, '{{ csrf_token() }}', '{{ route("remover_pedidos") }}');
				
			});
		
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
