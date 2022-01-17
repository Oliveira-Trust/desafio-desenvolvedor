 
@extends('includes.visitante')
@section('content') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
<div class="container mt-5" style="padding:30px;">

  
		<form id="formConversao" action="#" method="post" class="form-group">
		<div class="row mb-3">
				<div class="col-md-6">
				<label for="name">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control" required>	 
				</div>
				<div class="col-md-6">
				<label for="name">Sobrenome</label>
						<input type="text" name="sobrenome" id="sobrenome" class="form-control" required>	
				</div>
			
		</div>
		<div class="row mb-3">
		<div class="col-md-12">
				<label for="email">E-mail</label>
						<input type="text" name="email" id="email" class="form-control" required>	
				</div>
				  
		</div>
		   <div class="row mb-3">

                <div class="col-md-6">
				<label for="name">Quantidade (BRL)</label>
                 <input type="text" name="quantidade" id="quantidade" class="form-control">
				 <small id="quantidadeHelp" class="form-text">Insira um valor maior que BRL1000,00 e menor que BRL100.000,00.</small>	
		        </div>
				<script>  
				$( "#quantidade" )
					.keyup(function() {
					var value = [$("#quantidade").val()]; 
					if(value<1000){ 
								document.getElementById("btnSubmit").disabled = true; 
							$("#quantidadeHelp").css("color","red");  
						}else if(value>100000){  
								document.getElementById("btnSubmit").disabled = true; 
								$("#quantidadeHelp").css("color","red"); 
						}else {  
								document.getElementById("btnSubmit").disabled = false; 
								$("#quantidadeHelp").css("color","#6c757d"); 
						}
					})
					.keyup();  
  
				/*
					$( "#quantidade" )
						.keyup(function() {
						var value = [$("#quantidade").val()]; 
						if(value<1000){
							document.getElementById("btnSubmit").disabled = true;
							$("#quantidadeHelp").css("color","red");  
						}else if(value>100000){ 
								document.getElementById("btnSubmit").disabled = true;
								$("#quantidadeHelp").css("color","red"); 
						}else { 
								document.getElementById("btnSubmit").disabled = false; 
								$("#quantidadeHelp").css("color","#6c757d"); 
						}
						})
						.keyup();  */
				</script>
				  
			    <div class="col-md-6">
					<label for="name">Moeda destino</label>
						<select name="moedaDestino"  class="form-control">
							<option value='USD'>USD</option>  
							<option value='AUD'>AUD</option>
							<option value='BGN'>BGN</option> 
							<option value='CAD'>CAD</option>
							<option value='CHF'>CHF</option>
							<option value='CNY'>CNY</option>
							<option value='CZK'>CZK</option>
							<option value='DKK'>DKK</option>
							<option value='EUR'>EUR</option>
							<option value='GBP'>GBP</option>
							<option value='HKD'>HKD</option>
							<option value='HRK'>HRK</option>
							<option value='HUF'>HUF</option>
							<option value='IDR'>IDR</option>
							<option value='ILS'>ILS</option>
							<option value='INR'>INR</option>
							<option value='ISK'>ISK</option>
							<option value='JPY'>JPY</option>
							<option value='KRW'>KRW</option>
							<option value='MXN'>MXN</option>
							<option value='MYR'>MYR</option>
							<option value='NOK'>NOK</option>
							<option value='NZD'>NZD</option>
							<option value='PHP'>PHP</option>
							<option value='PLN'>PLN</option>
							<option value='RON'>RON</option>
							<option value='RUB'>RUB</option>
							<option value='SEK'>SEK</option>
							<option value='SGD'>SGD</option>
							<option value='THB'>THB</option>
							<option value='TRY'>TRY</option>
							<option value='USD'>USD</option>
							<option value='ZAR'>ZAR</option>
						</select>
				</div>


		   </div>  
		   <div class="row mb-3">
			   <div class="col-4">
			   <label for="name">Moeda destino</label>
			   <select name="formaPgto"  class="form-control">
							<option value='Boleto'>Boleto</option>  
							<option value='Cartão de crédito'>Cartão de crédito</option> 
						</select>
</div>
			</div>
	          
	       <div class="row">
	      	<div class="col-md-4">
	      	<input type="submit" name="submit" id="btnSubmit" class="btn btn-primary " style="background-color:#FFDD00;color:black;border:none;font-weight:600;" value="Converter" disabled>
	      	</div>
	      </div>
	          
		</form>  
	     <div id="output" style="display:none;">
	   <div class="accordion" id="accordionExample" >
	   <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Você receberá:&nbsp;<b><span class="moedaDestino"></span><span class="totalAdquirido"></span></b>&nbsp;&nbsp;<small id="quantidadeHelp" class="form-text">Clique aqui para ver todas as informações</small>	
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
	  <table class="table"> 
  <tbody>
    <tr> 
      <td>Moeda Origem:</td>
      <td><span class="moedaOrigem"></span></td> 
    </tr>
    <tr> 
      <td>Moeda Destino:</td>
      <td><span class="moedaDestino"></span></td> 
    </tr>
	<tr> 
      <td>Custo da conversão:</td>
      <td><span class="moedaOrigem"></span><span id="clientePagara"></span></td>
    </tr> 
	<tr> 
      <td>Forma de pagamento:</td>
      <td><span id="formaPgto"></span></td>
    </tr> 
    <tr> 
      <td>Taxa de pagamento:</td>
      <td><span class="moedaOrigem"></span><span id="valorTaxaPgto"></span></td>
    </tr>
	<tr> 
      <td>Taxa de conversão:</td>
      <td><span class="moedaOrigem"></span><span id="valorTaxaConversao"></span></td>
    </tr>
      <td>Valor a ser convertido:</td>
      <td><span class="moedaOrigem"></span><span id="valorConvertido"></span></td>
    </tr>
	<tr> 
      <td>Valor da moeda de destino:</td>
      <td><span class="moedaDestino"></span><span id="valorCurrencyDestino"></span></td>
    </tr>
	<tr> 
      <td>Você receberá:</td>
      <td><span class="moedaDestino"></span><span class="totalAdquirido" id="totalAdquirido"></span></td>
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </div>
					</div>
   
  </div>
</div>
  </div> 
@include('scripts.calcular')
@stop