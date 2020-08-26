<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">

		<!-- Máscara para os campos. -->
		<script src="/js/cleave.min.js"></script>
		<script src="/js/cleave-phone.br.js"></script>

		<script src="/js/classes/clientes.js"></script>
		
        <!-- Ícones. -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Formata CPF e telefone.
				let placeholderCpf = criarCampoCPF('placeholder-cpf');
				let placeholderTel = criarCampoTel('placeholder-tel');
				
				valorFormatadoCPF(placeholderCpf, '{{ $cliente->cpf }}', document.getElementById('cpf'));
				valorFormatadoTel(placeholderTel, '{{ $cliente->tel }}', document.getElementById('tel'));
			});
		
		</script>
		
		<title>Ver cliente - {{ $cliente->nome }}</title>
    </head>
    <body>
	
		@include('menu')
	
		<input type="text" id="placeholder-cpf">
		<input type="text" id="placeholder-tel">
		
		<div class="container">
		
			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<a class="link-retorno" href="/clientes/listar" title="Voltar para listagem">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>Voltar para listagem
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
			
					<h1>{{ $cliente->nome }}</h1>
					
					<p><strong>Login:</strong> {{ $cliente->login }}</p>
					<p><strong>CPF:</strong> <span id="cpf"><pan></p>
					<p><strong>Telefone:</strong> <span id="tel"><pan></p>
					<p><strong>E-mail:</strong> {{ $cliente->email }}</p>
				</div>
			</div>
		</div>
	
		<script src="/js/app.js"></script>
    </body>
</html>
