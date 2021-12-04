<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Conversor de Moedas</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" >
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>


    <link rel="stylesheet" href="{{ asset('css/main.css?122') }}">
</head>
<body>
    
 <div class="container">
   <header>
      <div id="logo">
         <img src="{{ asset('image/logotipo_padrao_grey.svg') }}" alt="">
      </div>
      <ul>
         <li> <a href="">Home</a> </li>
         <li> <a href="">Minhas Cotações</a> </li>
         <li> <a href="">Taxas</a> </li>
      </ul>
      <div class="flex-user">
         <span class="fa fa-user"></span> Olá, {{ $name ?? '' }} 
      </div>
   </header>
 </div>

 <section>
 	<div class="form-item">
 		<h2>Conversor de Moedas</h2>

 		<form class="" method="POST" action="{{ route('app.converte') }}" >
		   @csrf


 			<div class="input-group">
	 			<label>Moeda de origem BRL</label>
	 			<input type="text" name="moeda_origem" value="{{ number_format($cotacao['ask'], 2, ',', '.') }}" placeholder="Moeda de Origem">
 			</div>

 			<div class="input-group">
 				<label>Moeda de destino BRL</label>

				 <select name="moeda_destino">
 			   	    <option>* Selecione a moeda de destino </option>
 			   	    <option value="USD">USD</option>
 			   	    <option value="BTC">BTC</option>
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
 </section>

