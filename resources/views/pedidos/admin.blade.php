@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pedidos </div>

                <div class="card-body">
					<div class="card-body p-0">
						<table class="table">
						  <thead>
							<tr>
							  
							  <th>Pedido</th>
							  <th>Data</th>
							  <th>Status</th>
							  <th style="width: 40px" colspan=3 align="center">#</th>
							</tr>
						  </thead>
						  <tbody>
							@foreach($lista_pedidos as $pedidos)
								<tr>
									<td>  <a href="{{ url( 'detalhes' ) }}?p={{ $pedidos->id }}">{{ str_pad($pedidos->id, 4, 0, STR_PAD_LEFT) }}</a> </td>
									<td> {{ date("d/m/Y", strtotime($pedidos->data)) }} </td>
									<td> {{ $pedidos->status }} </td>
									@if($pedidos->status == "Em Aberto")
										<td> <a href="{{ url( 'tratar' ) }}?p={{ $pedidos->id }}&s=3" >Cancelar</a> </td>
										<td> <a href="{{ url( 'tratar' ) }}?p={{ $pedidos->id }}&s=2" >Pago</a> </td>
									@endif
								</tr>
							@endforeach
						  </tbody>
						</table>
					</div>

                </div>
				
				<div class="card-footer">
					 <a href="finalizar" type="submit" class="btn btn-primary">Finalizar Compra</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
