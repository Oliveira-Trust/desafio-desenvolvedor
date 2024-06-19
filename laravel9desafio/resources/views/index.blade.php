<x-layout title="Conversor de Moeda" breadcrumb="Conversor de Moeda">
	<main>
        <form action="/cotacao" method="post">
			<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
				@csrf
				<div class="row">
                    <div class="col-6 mb-3">
						<label class="form-label" for="moedaOrigem">Moeda de origem:</label>
                        <select class="form-control" id="moedaOrigem" name="moedaOrigem">
							<option value='BRL'>Real/BRL (BRL)</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-6 mb-3">
						<label class="form-label" for="moedaDestino">Moeda de destino:</label>
						<select class="form-control" id="moedaDestino" name="moedaDestino" required autofocus>
							<option value=''>Selecione a moeda de destino aqui</option>
							<option value='EUR'>Euro (EUR)</option>
							<option value='USD'>Dóllar dos Estados Unidos (USD)</option>
						</select>
					</div>
					<div class="col-6 mb-3">
						<label class="form-label" for="formaPag">Forma de pagamento:</label>
						<select class="form-control" id="formaPag" name="formaPag" required>
							<option value=''>Selecione a forma de pagamento aqui</option>
							<option value='B'>Boleto</option>
							<option value='C'>Cartão de crédito</option>
						</select>
					</div>
				</div>	

				<div class="row">
					<div class="col-12 mb-3">
						<label class="form-label" for="valorConversao">Valor para conversão:</label>
						<input class="form-control" id="valorConversao" name="valorConversao" type="number" step="0.01" min="1000.01" max="99999.99" required placeholder="Insira um valor entre R$1.000,00 e R$100.000,00">
					</div>
				</div>

                <div class="row">
					<div class="col-12 mb-3">
						<label class="form-label" for="resultadoConversao">Resultado da conversão:</label>
						<div id="resultadoConversao">
							<ul>
								@if (isset($cotacao))

									<li class="list-group-item">Moeda de origem: {{$cotacao->moedaOrigem}}</li>
									<li class="list-group-item">Moeda de destino: {{$cotacao->moedaDest}}</li>
									<li class="list-group-item">Valor para conversão: R${{$cotacao->valorConv}}</li>
									<li class="list-group-item">Forma de pagamento: {{$cotacao->formaPgto}}</li>
									<li class="list-group-item">Valor da "Moeda de destino" usado para conversão: ${{$cotacao->vlmoedaDest}}</li>
									<li class="list-group-item">Valor comprado em "Moeda de destino": ${{$cotacao->vlcompradoDest}}</li>
									<li class="list-group-item">Taxa de pagamento: R${{$cotacao->vltxPgto}}</li>
									<li class="list-group-item">Taxa de conversão: R${{$cotacao->vltxConv}}</li>
									<li class="list-group-item">Valor utilizado para conversão descontando as taxas: R${{$cotacao->vlconvTotal}}</li>
									
								@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 mb-3 mt-lg-3">
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div>
		</form>
    </main>
</x-layout>