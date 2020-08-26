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
		
        <title>Listar produtos</title>
		
    </head>
    <body>
	
		@include('menu')
		
		<div class="container">
		
			<div class="row">
				<div class="col-sm-12">
					
					<button id="remover" class="btn btn-danger float-left">
						<i class="fa fa-trash" aria-hidden="true"></i>Remover selecionados
					</button>
					
					<a id="criar" class="btn btn-primary float-right" href="/produtos/criar" title="Criar cliente">
						<i class="fa fa-plus" aria-hidden="true"></i>Adicionar
					</a>
					
				</div>
			</div>
		
		
			<div class="col-sm-12">
				<table id="produtos" class="display">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Descrição</th>
							<th>Preço (R$)</th>
							<th></th><!-- Ver mais -->
							<th></th><!-- Editar -->
							<th></th><!-- Excluir -->
						</tr>
					</thead>
					<tbody>
						@foreach ($produtos as $produto)
							<tr>
								<td>{{ $produto->id }}</td>
								<td class="selecionavel">{{ $produto->nome }}</td>
								<td class="selecionavel">{{ $produto->descricao }}</td>
								<td class="selecionavel">{{ number_format(floatval($produto->preco), 2, ",", "") }}</td>
								<td class="icone"><a href="/produtos/ver/{{ $produto->id }}" title="Ver mais">
									<i class="fa fa-eye" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/produtos/alterar/{{ $produto->id }}" title="Alterar">
									<i class="fa fa-pencil" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/produtos/remover/{{ $produto->id }}" title="Remover">
									<i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
					
					
					<tfoot>
						<tr>
							<th></th>
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
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

		
		<script>
			$(document).ready (function () {
				
				// Criação da tabela:
				let config = {
					columns: [
						{ orderable: false }, 	// id
						{ orderable: true }, 	// nome
						{ orderable: true }, 	// descrição
						{ orderable: true }, 	// preço
						{ orderable: false }, 	// ver mais
						{ orderable: false }, 	// alterar
						{ orderable: false } 	// remover
					],
					columnDefs: [
						{ 
							// Id não visível.
							visible: false, 
							targets: 0 
						},
						{ responsivePriority: 1, targets: 0 },	// nome
						{ responsivePriority: 2, targets: -3 },	// ver mais
						{ responsivePriority: 3, targets: -2 }, // alterar
						{ responsivePriority: 4, targets: -1 }	// remover
					], responsive: true
				};
				$.extend(config, DT_DEFAULT_OPTIONS);
				let tabela_produtos = $('#produtos').DataTable(config);
				
				
				// Filtragem:
				campoPesquisaRodape('produtos', tabela_produtos);
				
				
				// Manipulação dos itens em massa:
				adicionarClasseSelecionavel('produtos');
				exclusaoItensMassa(tabela_produtos, 0, '{{ csrf_token() }}', '{{ route("remover_produtos") }}');

			});
		
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
