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

		@if (count($clientes) > 0 && count($produtos) > 0)
		<script>
		
			document.addEventListener('DOMContentLoaded', function() {
				bindSubmitToFunction('criar_pedido', function () {
					submitFormCriarPedido(event, '{{ route("criar_pedido") }}');
				});
				
				bindSubmitToFunction('adicionar-produto', adicionarProduto);
				
				preencherPrimeiroProduto();
			});
			
		</script>
		
		@endif
		
		<title>Criar pedido</title>
		
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
		
			@if (count($clientes) > 0 && count($produtos) > 0)
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<form id="criar_pedido" method="POST">
						@csrf
						<div class="form-group">
							<label for="status">Status</label>
							<select name="status" class="form-control" id="status">
								<option value="1">Em Aberto</option>
								<option value="2">Pago</option>
								<option value="3">Cancelado</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="cliente_id">Cliente</label>
							<select name="cliente_id" class="form-control" id="cliente_id">
								@foreach ($clientes as $cliente)
									<option value="{{ $cliente->id }}">
										{{ $cliente->login }} - {{ $cliente->nome }}
									</option>
								@endforeach
							</select>
						</div>
						
						<div id="produtos-adicionados"></div>
						
						<p><strong>Total do pedido (R$):</strong> <span id="total-pedido">0,00</span></p>
						
						<button type="submit" class="btn btn-primary">Criar</button>
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
			
			@else
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<p>Não é possível adicionar pedidos se não houver clientes e/ou produtos. Por favor, 
					<a href="/clientes/criar" title="Adicione um cliente" target="_blank">adicione pelo menos um cliente</a> e 
					<a href="/produtos/criar" title="Adicione um produto" target="_blank">e pelo menos um produto</a> e recarregue esta página.</p>
				</div>
			</div>
			
			@endif
		</div>
	
		<script src="/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
