<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">
		
		<script src="/js/BaseRequest.js"></script>
		<script>
			// Listagem de produtos utilizada nas funções.
			var produtos = '{{ json_encode($produtos) }}';
			produtos = JSON.parse(produtos.replace(/&quot;/g, '"'));
			
		</script>
		
		<script src="/js/classes/pedidos.js"></script>

        <!-- Ícones. -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script>

			document.addEventListener('DOMContentLoaded', function() {
				bindSubmitToFunction('alterar_pedido', function () {
					submitFormAlterarPedido(event, '{{ route("alterar_pedido", [ "id" => $pedido->id ] ) }}');
				});
				
				bindSubmitToFunction('adicionar-produto', adicionarProduto);
				
				preencherPrimeiroProduto();
				
				// Adiciona os produtos anteriores do pedido:
				@foreach ($pedido->produtos as $produto)
					document.getElementById('produtos-adicionados').innerHTML += produtoAdicionado (
						'{{ $produto->id }}', 
						'{{ $produto->pedido_produtos->produto_quant }}', 
						'{{ $produto->preco * $produto->pedido_produtos->produto_quant }}', 
						'{{ $produto->nome }}', 
						'{{ $produto->preco }}'
					);
				@endforeach
				
			});
		
        </script>
		
		<title>Alterar pedido ID {{ $pedido->id }}</title>
		
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
					<form id="alterar_pedido" method="POST">
						@csrf
						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" class="form-control" id="status">
								<option value="1" 
									@if ($pedido->status == "Em Aberto") selected @endif
								>Em Aberto</option>
								<option value="2" 
									@if ($pedido->status == "Pago") selected @endif
								>Pago</option>
								<option value="3" 
									@if ($pedido->status == "Cancelado") selected @endif
								>Cancelado</option>
							</select>
						</div>
						
			
						<div class="form-group">
							<label for="cliente_id">Cliente</label>
							<select name="cliente_id" class="form-control" id="cliente_id">
								@foreach ($clientes as $cliente)
									<option value="{{ $cliente->id }}" 
										@if ($pedido->cliente->id == $cliente->id) selected @endif
										>{{ $cliente->login }} - {{ $cliente->nome }}
									</option>
								@endforeach
							</select>
						</div>
				
					<div id="produtos-adicionados"></div>
						
						<p><strong>Total do pedido (R$):</strong> 
							<span id="total-pedido">{{ number_format(floatval($pedido->total), 2, ",", "") }}</span>
						</p>
						
						<button type="submit" class="btn btn-primary">Alterar</button>
					</form>	
					
					
					<form id="adicionar-produto" method="POST">
						<h2>Produtos</h2>
							
						<div class="form-group">	
							<label for="produto_id">Produto</label>
							<select name="produto_id" class="form-control" id="produto_id" onchange="atualizaValoresProduto();" required>
								@foreach ($produtos as $produto)
									<option value="{{ $produto->id }}">
										{{ $produto->nome }}
									</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group">
							<label for="quantidade">Quantidade</label>
							<input type="number" name="quantidade" class="form-control" id="quantidade" step="1" min="1" value="1" onchange="atualizaValoresProduto();" required>
						</div>
						
						<p><strong>Preço do produto (R$):</strong> <span id="preco-produto"></span></p>
						
						<p><strong>Subtotal produto (R$):</strong> <span id="subtotal-produto"></span></p>
						
						<button class="btn btn-secondary" type="button" onclick="adicionarProduto();">Adicionar produto</button>
						
					</form>
				</div>
			</div>
		</div>
	
		<script src="/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
