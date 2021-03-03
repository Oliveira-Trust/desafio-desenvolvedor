<?php 
	function valorDolar($valor){
		$ch = curl_init("https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='".date("m-d-Y", strtotime(date("Y-m-d")."-1 day"))."'&format=json");

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$res_curl = curl_exec($ch);
		if(curl_error($ch)) {
			echo curl_error($ch);
		} else {
		 $resultado = json_decode($res_curl, true);
		 $valores = $resultado["value"][0];
		 //Agora será possível recuperar a informação da cotação do dólar:
		 $dolar = $valores["cotacaoCompra"];

		}
		curl_close($ch);
		
		$total = $valor/$dolar;
		
		return $total;
	}
?>