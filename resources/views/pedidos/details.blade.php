
@extends('layouts.app')

@section('content')
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
