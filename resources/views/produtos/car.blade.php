@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			
            <div class="card">
                <div class="card-header">Carrinho de Compras </div>
				
				@if(count($lista_produtos) >0 )
                <div class="card-body">
					<div class="card-body p-0">
						<table class="table">
						  <thead>
							<tr>
							  
							  <th>Produto</th>
							  <th>Preço</th>
							  <th style="width: 40px">Remover</th>
							</tr>
						  </thead>
						  <tbody>
							<?php $total=0; ?>
							@foreach($lista_produtos as $produtos)
							<tr>
								<td> {{ $produtos->nome }} </td>
								<td> R$ {{ number_format( $produtos->preco , 2, ',', '.') }} </td>
								<td> <a  href="{{ url( 'remover' ) }}?id={{ $produtos->id }}"><img style="width:45%;" src="img/del.png" /></a> </td>
							</tr>
							<?php $total+=$produtos->preco; ?>
							@endforeach
						  </tbody>
						  <tfoot>
							<tr>	
								<th> TOTAL R$ {{ number_format( $total , 2, ',', '.') }} </th>
							</tr>
						  </tfoot>
						</table>
					</div>
                </div>
				
				<div class="card-footer">
					 <a href="finalizar" type="submit" class="btn btn-primary">Finalizar Compra</a>
				</div>
				@else
				<div class="card-footer">
					 Carrinho Vazio
				</div>
				@endif
            </div>
			
				
        </div>
    </div>
</div>
@endsection
