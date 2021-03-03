@extends('layouts.app')

@section('content')

<!-- Filtro de Produtos -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Produtos </div>
				<form role="form" method="post" action="{{ url( 'massivo' ) }}" enctype="multipart/form-data" >
                <div class="card-body">
					<div class="card-body p-0">
						<table class="table">
						  <thead>
							<tr>
							  
							  
							  <th colspan=3>Produto</th>
							  <th>Preço</th>
							  <th style="width: 40px">Editar</th>
							  <th style="width: 40px">Ativar/Desativar</th>
							</tr>
						  </thead>
						 
						  <tbody>
							
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								@foreach($lista_produtos as $produtos)
									<tr>
										<td style="width:2%;"> <input type="checkbox" name="itens[]" value="{{ $produtos->id }}"> </td>
										<td style="width:5%;"> <img style="width:100%;" src="{{ $produtos->imagem }}" /> </td>
										<td> {{ $produtos->nome }}  </td>
										<td> {{ $produtos->preco }}  </td>
										<td style="width:5%;"> <a  href="#" data-toggle='modal' data-target="#edit{{$produtos->id}}"> <img style="width:50%;" src="img/pencil.png" /> </a></td>
										<td style="width:5%;" align="center">
											@if($produtos->ativo == 1)
												<a href="{{ url( 'desativar' ) }}?p={{$produtos->id}}"><img src="img/off.png" style="width:30%;" /></a>
											@else
												<a href="{{ url( 'ativar' ) }}?p={{$produtos->id}}"><img src="img/on.png" style="width:30%;" /></a>
											@endif
										</td>
									</tr>
								@endforeach
							
						  </tbody>

						  
						</table>
					  </div>
					  <input type="submit" class="btn btn-danger" name="send_massa" Value="Remover Produtos Selecionatos" />
                </div>
				
				</form>
            </div>
        </div>
    </div>
</div>
@endsection

@foreach($lista_produtos as $produtos)
		<form role="form" method="post" action="{{ url( 'atualizar' ) }}" enctype="multipart/form-data" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="id" value="{{$produtos->id}}">
		<div class="modal fade" id="edit{{$produtos->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{ $produtos->nome }} </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>

					<div class="modal-body">
						<div class="card-body">
						  <div class="form-group">
							<label for="exampleInputEmail1">Nome do Produto</label>
							<input type="text" class="form-control" placeholder="Produto" name="nome" value="{{ $produtos->nome }}" required >
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Preço</label>
							<input type="number" class="form-control" placeholder="R$" name="preco" value="{{ $produtos->preco }}" required>
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputFile">Imagem</label>
							<div class="input-group">
							  <div class="custom-file">
								<input type="file" class="custom-file-input" name="file" >
								<label class="custom-file-label" for="exampleInputFile">Escolha um arquivo</label>
							  </div>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Descrição</label>
							<textarea class="form-control" name="descricao" >{{ $produtos->descricao }}</textarea>
						  </div>

						</div>

					</div>
					<div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Atualizar' name="atualizar" > 
					</div>

				</div>
			</div>
		</div>
		</form>
@endforeach

					 