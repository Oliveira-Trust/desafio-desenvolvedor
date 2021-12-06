@extends('app.layout.base')

@section('conteudo')

 <section>
 	<div class="form-item">
 		<h2>Conversor de Moedas</h2>

 		<form class="" method="POST" action="{{ route('app.converte') }}" >
		   @csrf

 			<div class="input-group">
	 			<label>Moeda de origem BRL</label>
	 			<input type="text" name="moeda_origem" value="BRL" placeholder="Moeda de Origem">
				 {{-- <input type="text" name="moeda_origem" value="{{ number_format($cotacao['ask'], 2, ',', '.') }}" placeholder="Moeda de Origem"> --}}
 			</div>

 			<div class="input-group">
 				<label>Moeda de destino BRL</label>

				 <select name="moeda_destino">
 			   	    <option>* Selecione a moeda de destino </option>
 			   	    <option value="USD">USD</option>
 			   	    <option value="EUR">EUR</option>
 			   </select>
 			</div>

 			<div class="input-group">
 				<label>Valor para conversão</label>
 			    <input type="text" name="valor_conversao" placeholder="$ Valor para conversão">
 			</div>

 			<div class="input-group">
 				<label>Formato de pagamento</label>
 			   <select name="formato_pagamento">
 			   	    <option>* Selecione o formato de pagamento</option>
 			   	    <option value="boleto">Boleto</option>
 			   	    <option value="cartao_credito">Cartão de Crédito</option>
 			   </select>
 			</div>

 			<div class="input-group">
 				<label></label>
 			    <input type="submit" name="converter" class="connvert-button" value="Converter">
				
 			</div>
 		</form>

 	</div>

	 
 <div class="text-context">
   @foreach($errors->all() as $error)
        <span>{{$error}}</span>
   @endforeach

 </div>

 </section>

@endsection