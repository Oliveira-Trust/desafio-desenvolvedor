

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
    <div class="row justify-content-left">
		<div class="col-md-12" style="margin-top: 2px;">
			<form action="" method="get" >
				<div class="card">
					<div class="card-header">Filtro </div>

					<div class="card-body">
						 <div class="form-group">
						  <div class="row justify-content-left">
							<div class="col-md-3" style="margin-top: 2px;height:20%;">
							<label for="exampleInputEmail1">Nome do Produto</label>
							<input type="text" class="form-control" placeholder="Pesquise o nome do produto" name="nome" <?php if(isset($_GET["pesquisar"])) echo "value='".$_GET["nome"]."'" ?> >
						  </div>
						  <div class="col-md-3" style="margin-top: 2px;height:20%;">
							<label for="exampleInputEmail1">Valor Mínimo </label>
							<input type="number" class="form-control" name="minimo" <?php if(isset($_GET["pesquisar"])) echo "value='".$_GET["minimo"]."'" ?> >
						  </div>
						    <div class="col-md-3" style="margin-top: 2px;height:20%;">
							<label for="exampleInputEmail1">Valor Máximo </label>
							<input type="number" class="form-control" name="maximo" <?php if(isset($_GET["pesquisar"])) echo "value='".$_GET["maximo"]."'" ?>>
						  </div>
						  
						  <div class="col-md-3" style="margin-top: 2px;height:20%;"><br>
							<input type="submit" class="btn btn-primary" value="Pesquisar" name="pesquisar" />
						  </div>
						  </div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container" style="margin-top: 20px;">
    <div class="row justify-content-left">
	
		@foreach($lista_produtos as $produtos)
        <div class="col-md-4" style="margin-top: 2px;height:20%;">
            <div class="card" >
                

                <div class="card-body">
				<table>
					<tr> 
						<td> <img style="width:40%;height:50px;" src="{{ $produtos->imagem }}" /> </td> 
						
					</tr>
					<tr> 
						<td> <a href="#" data-toggle='modal' data-target="#desc{{$produtos->id}}">{{ $produtos->nome }}</a> </td> 
					</tr>
					<tr> 
						<td style="width:65%;"> R$ {{ number_format( $produtos->preco , 2, ',', '.') }} - U$ {{ number_format( valorDolar($produtos->preco) , 2, ',', '.') }}</td> 
						<td style="width:35%;"> <a href="{{ url( 'addCarrinho' ) }}?p={{ $produtos->id }}" > <img style="width:35%;" src="img/add.png"> </a></td>
					</tr>
				</table>
                </div>
				
            </div>
        </div>
		@endforeach
    </div>
</div>


@foreach($lista_produtos as $produtos)

		<div class="modal fade" id="desc{{$produtos->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{ $produtos->nome }} </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>

					<div class="modal-body">
						{{ $produtos->descricao }}

					</div>
					
					<div class="modal-body">
						R$ {{ number_format( $produtos->preco , 2, ',', '.') }} - U$ {{ number_format( valorDolar($produtos->preco) , 2, ',', '.') }}

					</div>

					<div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<a href="{{ url( 'addCarrinho' ) }}?p={{ $produtos->id }}" class="btn btn-success" value='Atualizar' name="atualizar" > Adicionar ao Carrinho <img style="width:7%;" src="img/car.png"> </a>
					</div>

				</div>
			</div>
		</div>
	
@endforeach
@endsection
