@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novo Produto </div>

                <div class="card-body">
                    <!-- form start -->
					  <form role="form" method="post" action="{{ url( 'criarproduto' ) }}" enctype="multipart/form-data" >
					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card-body">
						  <div class="form-group">
							<label for="exampleInputEmail1">Nome do Produto</label>
							<input type="text" class="form-control" placeholder="Produto" name="nome">
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Preço</label>
							<input type="text" class="form-control" placeholder="R$" name="preco">
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
							<textarea class="form-control" name="descricao" ></textarea>
						  </div>

						</div>
						<!-- /.card-body -->

						<div class="card-footer">
						  <button type="submit" class="btn btn-primary">Cadastrar</button>
						</div>
					  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
