<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >

		<script src="/js/BaseRequest.js"></script>
		<script src="/js/BaseDataTables.js"></script>
		
		<!-- Máscara para alguns campos. -->
		<script src="/js/cleave.min.js"></script>
		<script src="/js/cleave-phone.br.js"></script>
		
		<script src="/js/classes/clientes.js"></script>
		
		<!-- Ícones -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		
		<title>Listar clientes</title>
    </head>
    <body>
	
		@include('menu')
		
		<input type="text" id="placeholder-cpf">
		<input type="text" id="placeholder-tel">
		
		<div class="container">
		
		
			<div class="row">
				<div class="col-sm-12">
					
					<button id="remover" class="btn btn-danger float-left">
						<i class="fa fa-trash" aria-hidden="true"></i>Remover selecionados
					</button>
					
					<a id="criar" class="btn btn-primary float-right" href="/clientes/criar" title="Criar cliente">
						<i class="fa fa-plus" aria-hidden="true"></i>Adicionar
					</a>
					
				</div>
			</div>
			
		
			<div class="col-sm-12">
				<table id="clientes" class="display">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Login</th>
							<th>CPF</th>
							<th>Telefone</th>
							<th>E-mail</th>
							<th></th><!-- Ver mais -->
							<th></th><!-- Editar -->
							<th></th><!-- Excluir -->
						</tr>
					</thead>
					<tbody>
						@foreach ($clientes as $cliente)
							<tr>
								<td>{{ $cliente->id }}</td>
								<td class="selecionavel">{{ $cliente->nome }}</td>
								<td class="selecionavel">{{ $cliente->login }}</td>
								<td class="cpf selecionavel">{{ $cliente->cpf }}</td>
								<td class="tel selecionavel">{{ $cliente->tel }}</td>
								<td class="selecionavel">{{ $cliente->email }}</td>
								
								<td class="icone"><a href="/clientes/ver/{{ $cliente->id }}" title="Ver mais">
									<i class="fa fa-eye" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/clientes/alterar/{{ $cliente->id }}" title="Alterar">
									<i class="fa fa-pencil" aria-hidden="true"></i></a>
								</td>
								<td class="icone"><a href="/clientes/remover/{{ $cliente->id }}" title="Remover">
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
				// Formata CPF e telefone.
				let placeholderCpf = criarCampoCPF('placeholder-cpf');
				let placeholderTel = criarCampoTel('placeholder-tel');
				
				$('.cpf').toArray().forEach(function(elemento) {
					valorFormatadoCPF(placeholderCpf, elemento.innerHTML, elemento);
				});
				
				$('.tel').toArray().forEach(function(elemento) {
					valorFormatadoTel(placeholderTel, elemento.innerHTML, elemento);
				});
				
				
				// Criação da tabela:
				let config = {
					columns: [
						{ orderable: false }, 	// id
						{ orderable: true }, 	// nome
						{ orderable: true }, 	// login
						{ orderable: true }, 	// cpf
						{ orderable: true }, 	// telefone
						{ orderable: true }, 	// e-mail
						{ orderable: false }, 	// ver mais
						{ orderable: false },	// alterar
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
					],
					responsive: true,
					
				};
				$.extend(config, DT_DEFAULT_OPTIONS);
				let tabela_clientes = $('#clientes').DataTable(config);
				
				
				// Filtragem:
				campoPesquisaRodape('clientes', tabela_clientes);
				
				
				// Manipulação dos itens em massa:
				adicionarClasseSelecionavel('clientes');
				exclusaoItensMassa(tabela_clientes, 0, '{{ csrf_token() }}', '{{ route("remover_clientes") }}');
				
				
			});
		
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
