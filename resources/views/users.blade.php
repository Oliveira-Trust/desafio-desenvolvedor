@extends('layouts.app')
@section('content')

<!--Filtro de Usuários -->
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
							<label for="exampleInputEmail1">Nome do Cliente</label>
							<input type="text" class="form-control" placeholder="Pesquise o nome do produto" name="nome" <?php if(isset($_GET["pesquisar"])) echo "value='".$_GET["nome"]."'" ?> >
						  </div>
						 <div class="col-md-3" style="margin-top: 2px;height:20%;">
							<label for="exampleInputEmail1">E-mail</label>
							<input type="text" class="form-control" placeholder="Pesquise o nome do produto" name="email" <?php if(isset($_GET["pesquisar"])) echo "value='".$_GET["email"]."'" ?> >
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clientes </div>
                <div class="card-body">
					<div class="card-body p-0">
						<table class="table">
						  <thead>
							<tr>
							  
							  <th>Nome</th>
							  <th>Email</th>
							  <th style="width: 40px">Status</th>
							</tr>
						  </thead>
						  <tbody>
							@foreach($lista_usuarios as $usuarios)
								<tr>
									
									<td> {{ $usuarios->name }} </td>
									<td> {{ $usuarios->email }} </td>
									<td>
										@if($usuarios->active == 1)
											<a href="{{ url( 'edituser' ) }}?p={{$usuarios->id}}&a=0"><img src="img/off.png" style="width:60%;" /></a>
										@else
											<a href="{{ url( 'edituser' ) }}?p={{$usuarios->id}}&a=1"><img src="img/on.png" style="width:60%;" /></a>
										@endif
									</td>

								</tr>
							@endforeach
						  </tbody>
						</table>
					</div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
