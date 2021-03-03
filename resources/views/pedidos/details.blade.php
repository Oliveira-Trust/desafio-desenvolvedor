
@extends('layouts.app')

@section('content')
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Pedido <?php echo str_pad($_GET["p"], 4, 0, STR_PAD_LEFT); ?> </div>

                <div class="card-body">
					<div class="container">
						
						
							@foreach($detalhes as $itens)
							<div class="row justify-content-left">
								<div class="col-md-12" style="margin-top: 2px;height:20%;">
									<div class="card" >

										<div class="card-body">
											<table>
												<tr> 
													<td style="width:65%;"> <img style="width:25%;" src="{{ $itens->imagem }}" /> </td> 
													<td> {{ $itens->descricao }} </td> 
												</tr>
												<tr> 
													<td> {{ $itens->nome }} </td> 
												</tr>
												<tr> 
													<td style="width:65%;"> R$ {{ number_format( $itens->preco , 2, ',', '.') }} - U$ {{ number_format( valorDolar($itens->preco) , 2, ',', '.') }}</td> 
													
												</tr>
											</table>
										</div>
										
									</div>
								</div>
							</div>
							@endforeach
						
					</div>

                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
