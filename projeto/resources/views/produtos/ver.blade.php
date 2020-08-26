<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">

        <!-- Ícones -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <title>Ver produto - {{ $produto->nome }}</title>
	   
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
					<h1>{{ $produto->nome }}</h1>
					
					<p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
					
					<p><strong>Preço:</strong> R$ {{ number_format(floatval($produto->preco), 2, ",", "") }}</p>
				</div>
			</div>
		</div>
	
		<script src="/js/app.js"></script>
    </body>
</html>
