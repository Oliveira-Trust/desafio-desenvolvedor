<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>

<style>
	body {
		background-color: #f4f4f4;
		font-family: Arial, Helvetica, sans-serif;
		margin: 200;
	}
	.container {
		max-width: 800px;
		margin: 0 auto;
		padding: 20px;
	}
	h1 {
		color: #4CAF50;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
	}
	p {
		font-family: Arial, Helvetica, sans-serif;
		font-size:18px;
	}
	p2 {
		font-size: 10px;
		font-family: Arial, Helvetica, sans-serif;
	}
	p3 {
		font-size: 25px;
		font-family: Arial, Helvetica, sans-serif;
	}
	label {
		font-family: Arial, Helvetica, sans-serif;
		font-size:18px;
	}
	#escolha {
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		width: 700px;
		margin: 0 auto;
		text-align: center;
	}
	#caixa1 {
		border-radius: 10px;
		padding: 20px; 
		width: 700px;
		height: 50px;
		margin: 0 auto;
	}
	#caixa2 {
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		width: 700px;
		margin: 0 auto;
	}
	table {
		width: 75%;
		text-align: center;
	}
	th {
		text-align: right;
		border-bottom: 1px solid #ddd;
	}
	td {
		text-align: left;
		border-bottom:  1px solid #ddd;
	}
</style>

<title>Conversor de Moedas</title>

</head>

<body>
<h1>Conversor de Moedas &#128177;</h1>

<!--SELEÇÃO DA MOEDA, FORMA DE PAGAMENTO E VALOR CONVERTIDO-->
<form id="escolha">
	<p>Selecione a sua moeda de destino:</p>
	<input type="radio" id="usd" name="moeda" value="USD" required>
	<label for="usd">USD</label>
	<input type="radio" id="eur" name="moeda" value="EUR" required>
	<label for="eur">EUR</label>
	<input type="radio" id="gbp" name="moeda" value="GBP" required>
	<label for="gbp">GBP</label> <br>
	<p>Selecione a forma de pagamento desejada:</p>
	<input type="radio" id="boleto" name="pagamento" value="Boleto" required>
	<label for="boleto">Boleto</label>
	<input type="radio" id="credito" name="pagamento" value="Cartão de crédito" required>
	<label for="credito">Cartão de crédito</label> <br> <br>
	<label for="brl">Valor a ser convertido: </label>
	<input type="number" id="brl" name="brl" min="1000" max="100000" required> <br> <br>
	<input type="submit" value="Converter">
	<br>
</form>

<div id="caixa1">
	<p2>Observações:</p2> <br>
	<p2>Valor deve estar entre R$1.000,00 e R$100.000,00.</p2> <br>
	<p2>É aplicada uma taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00.</p2> <br>
	<p2>É aplicada uma taxa de de 1,45% por pagamentos por boleto e 7,63% por pagamentos no cartão de crédito.</p2> 
</div> <br>

<!--MOSTRANDO RESULTADO-->
<div id="caixa2">
	<table>
		<tr>
			<th>Moeda de origem:</th>
			<td>BRL </td>
		</tr>
		<tr>
			<th>Moeda de destino:</th>
			<td id="moedaDeDestino"></td>
		</tr>
		<tr>
			<th>Valor para conversão:</th>
			<td id="valorParaConversao"></td>
		</tr>
		<tr>
			<th>Forma de pagamento:</th>
			<td id="formaDePagamento"></td>
		</tr>
		<tr>
			<th>Valor da "Moeda de destino" usado para conversão:</th>
			<td id="valorDaMoedaDeDestino"></td>
		</tr>
		<tr>
			<th>Valor comprado em "Moeda de destino"*:</th>
			<td id="valorCompradoEmMoedaDeDestino"></td>
		</tr>
		<tr>
			<th>Taxa de pagamento:</th>
			<td id="taxaDePagamento"></td>
		</tr>
		<tr>
			<th>Taxa de conversão:</th>
			<td id="taxaDeConversao"></td>
		</tr>
		<tr>
			<th>Valor utilizado para conversão descontando as taxas:</th>
			<td id="valorParaConversaoMenosTaxas"></td>
		</tr>
	</table> <br>
</div>

<script>
//GERANDO E APRESENTANDO O RESULTADO
document.getElementById("escolha").addEventListener("submit", async function(event) {
	event.preventDefault();

	//Selecionando moeda
	var moeda = document.querySelector("input[name='moeda']:checked").value;

	//Selecionando modo de pagamento
	var formaPagamento = document.querySelector("input[name='pagamento']:checked").value;

	//Pegando valor da moeda destino do API
	let url = "https://economia.awesomeapi.com.br/last/BRL-" + moeda; //definindo URL

	try {
		let resposta = await fetch(url);
	
		if (!resposta.ok) {throw new Error("Erro ao acessar a API");} //Checando se fetch foi ok

		let dadosAPI = await resposta.json();
		console.log(dadosAPI);

		switch(moeda) {
			case "USD":
				var valorMoedaDestino = parseFloat(dadosAPI.BRLUSD.high);
				break;
			case "EUR":
				var valorMoedaDestino = parseFloat(dadosAPI.BRLEUR.high);
				break;
			case "GBP":
				var valorMoedaDestino = parseFloat(dadosAPI.BRLGBP.high);
				break;
			default:
				throw new Error("Erro ao acessar a API");
				break;
		}
			
		//Calculando taxas
		var taxaPagamentoPercentual = (document.getElementById("boleto").checked ? 0.0145 : 0.0763);
		var taxaConversaoPercentual = (document.getElementById("brl").value < 3000 ? 0.02 : 0.01);

		var taxaPagamento = document.getElementById("brl").value * taxaPagamentoPercentual;
		var taxaConversao = document.getElementById("brl").value * taxaConversaoPercentual;

		//Calculando resultado
		var valorMenosTaxas = document.getElementById("brl").value - taxaPagamento - taxaConversao;
		var valorComprado = valorMenosTaxas * valorMoedaDestino;

		//APRESENTANDO O RESULTADO
		document.getElementById("moedaDeDestino").innerHTML = moeda;
		document.getElementById("valorParaConversao").innerHTML = "R$ " + parseFloat(document.getElementById("brl").value).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
		document.getElementById("formaDePagamento").innerHTML = formaPagamento;
		document.getElementById("valorDaMoedaDeDestino").innerHTML = (1/valorMoedaDestino).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + " " + moeda;
		document.getElementById("valorCompradoEmMoedaDeDestino").innerHTML = valorComprado.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + " " + moeda; 
		document.getElementById("taxaDePagamento").innerHTML = "R$ " + taxaPagamento.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
		document.getElementById("taxaDeConversao").innerHTML = "R$ " + taxaConversao.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
		document.getElementById("valorParaConversaoMenosTaxas").innerHTML = "R$ " + valorMenosTaxas.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
	
		console.log(url); // url mostrado no console para qualquer dúvida

	} catch (error) {console.error(error);}
});

</script>

<div id="caixa1">
	<p2>* taxas aplicadas no valor de compra diminuindo no valor total de conversão</p2>
	<br> <p2>Rafael Possidente</p2>
</div>

</body>

</html>




