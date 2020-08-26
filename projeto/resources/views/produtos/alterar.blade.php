<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">
		
		<script src="/js/BaseRequest.js"></script>
		
		<script src="/js/classes/produtos.js"></script>

        <!-- Ícones. -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script>
		
			document.addEventListener('DOMContentLoaded', function() {
				bindSubmitToFunction('alterar_produto', function() {
					submitFormAlterarProduto(event, '{{ route("alterar_produto", [ "id" => $produto->id ] ) }}');
				});
				
			});
		
        </script>
		
		<title>Alterar produto - {{ $produto->nome }}</title>
		
    </head>
    <body>
	
		@include('menu')
		
		<div class="container">
		
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<a class="link-retorno" href="/produtos/listar" title="Voltar para listagem">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>Voltar para listagem
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<form id="alterar_produto" method="POST">
						@csrf
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome do produto" value="{{ $produto->nome }}" required>
						</div>
						<div class="form-group">
							<label for="descricao">Descrição</label>
							<textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição do produto" required>{{ $produto->descricao }}</textarea>
						</div>
						<div class="form-group">
							<label for="preco">Preço (em R$)</label>
							<input type="number" name="preco" class="form-control" id="preco" placeholder="Preço do produto" step="0.01" value="{{ $produto->preco }}" required>
						</div>
						<button type="submit" class="btn btn-primary">Alterar</button>
					</form>	
				</div>
			</div>
		</div>
	
		<script src="/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
