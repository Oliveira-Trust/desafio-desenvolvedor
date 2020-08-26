<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">

        <!-- Ícones. -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <title>Ver pedido ID {{ $pedido->id }}</title>
		
    </head>
    <body>
	
		@include('menu')
		
		<div class="container">
		
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<a class="link-retorno" href="/pedidos/listar" title="Voltar para listagem">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>Voltar para listagem
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<h1>Pedido ID {{ $pedido->id }}</h1>
					
					<p><strong>Status:</strong> {{ $pedido->status }}</p>
					
					<p>
						<strong>Cliente:</strong> 
						<a href="/clientes/ver/{{ $pedido->cliente->id }}" title="Ver cliente">
							{{ $pedido->cliente->nome }}
						</a>
					</p>
					<p><strong>Data de criação:</strong> {{ $data_criacao_str }}</p>
					<p><strong>Data de última atualização:</strong> {{ $data_atualizacao_str }}</p>
					<p><strong>Total (R$):</strong> {{ number_format(floatval($pedido->total), 2, ",", "") }}</p>
				</div>	
				
			</div>
			
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<h2>Produtos</h2>
					
					<table>
						<thead>
							<th>Nome</th>
							<th>Preço</th>
							<th>Quantidade</th>
						</thead>
						<tbody>
							@foreach ($pedido->produtos as $produto)
								<tr>
									<td><a href="/produtos/ver/{{ $produto->id }}" title="Ver produto {{ $produto->nome }}">{{ $produto->nome }}</a></td>
									<td>{{ number_format(floatval($produto->preco), 2, ",", "") }}</td>
									<td>{{{ $produto->pedido_produtos->produto_quant }}}</td>
								</tr>
							@endforeach
						
						</tbody>
					
					</table>
					
					
				</div>	
				
			</div>
		</div>
	
		<script src="/js/app.js"></script>
    </body>
</html>
