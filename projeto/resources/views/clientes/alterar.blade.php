<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">
		
		<script src="/js/BaseRequest.js"></script>

		<!-- Máscara para os campos. -->
		<script src="/js/cleave.min.js"></script>
		<script src="/js/cleave-phone.br.js"></script>
		
		<script src="/js/classes/clientes.js"></script>
		
		<!-- Ícones. -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		
        <script>
			document.addEventListener('DOMContentLoaded', function() {
				bindSubmitToFunction('alterar_cliente', function() {
					submitFormAlterarCliente(event, '{{ route("alterar_cliente", [ "id" => $cliente->id ] ) }}');
				});
				
				let cpf = criarCampoCPF('cpf');
				let tel = criarCampoTel('tel');
				
			});
		
        </script>
		
		<title>Alterar cliente - {{ $cliente->nome }}</title>
		
    </head>
    <body>
	
		@include('menu')
		
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
					<form id="alterar_cliente" method="POST">
						@csrf
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome do cliente" value="{{ $cliente->nome }}" required>
						</div>
						
						<div class="form-group">
							<label for="login">Login</label>
							<input type="text" name="login" class="form-control" id="login" placeholder="Login do cliente" value="{{ $cliente->login }}" required>
						</div>
						
						<div class="form-group">
							<label for="senha">Senha</label>
							<input type="password" name="senha" class="form-control" id="senha" placeholder="Senha do cliente" required>
						</div>
						
						<div class="form-group">
							<label for="cpf">CPF</label>
							<input type="text" name="cpf" class="form-control" id="cpf" placeholder="CPF do cliente" value="{{ $cliente->cpf }}" required>
						</div>
						
						<div class="form-group">
							<label for="tel">Telefone</label>
							<input type="text" name="tel" class="form-control" id="tel" placeholder="Telefone do cliente" value="{{ $cliente->tel }}" required>
						</div>
						
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="E-mail do cliente" value="{{ $cliente->email }}" required>
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
