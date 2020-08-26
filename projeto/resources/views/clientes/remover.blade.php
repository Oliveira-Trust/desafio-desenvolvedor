<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/custom.css" rel="stylesheet">

		<script src="/js/BaseRequest.js"></script>
		<script src="/js/classes/clientes.js"></script>

		<!-- Ícones -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

         <script>
			document.addEventListener('DOMContentLoaded', function() {
				bindSubmitToFunction('remover_cliente', function() {
					submitFormRemoverCliente(event, '{{ route("remover_cliente", [ "id" => $cliente->id ] ) }}');
				});
			});
		
        </script>
		
		<title>Remover cliente - {{ $cliente->nome }}</title>
		
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
					<form id="remover_cliente" method="POST">
						@csrf
						<p>Deseja realmente remover o cliente <strong>{{ $cliente->nome }}</strong>?</p>
						<button type="submit" class="btn btn-primary">Remover</button>
					</form>	
				</div>
			</div>
		</div>
	
		<script src="/js/app.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    </body>
</html>
