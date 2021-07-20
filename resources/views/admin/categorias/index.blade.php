@extends('layouts.app')

@section('title') Categorias @endsection

@section('content')
	<categorias-index></categorias-index>
	{{-- <div>
		<div class="row">
			<div class="col-xl-10 col-sm-6 py-4">
				<h3>@yield('title')</h3>
			</div>
			<div class="col-xl-2 col-sm-6 py-4">
				<a href="{{route('admin.categorias.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Adicionar</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="table-responsive-md table-responsive-sm">
					<table class="table table-striped table-bordered table-hover table-sm">
						<thead class="thead-dark">
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Nome</th>
								<th scope="col">Qtd. Produtos</th>
								<th scope="col">Criado em</th>
								<th scope="col">Atualizado em</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($categories as $category)
								<tr>
									<th scope="row" class="align-middle">{{$category->id}}</th>
									<td class="align-middle">{{$category->name}}</td>
									<td class="align-middle text-center">{{$category->product->count()}}</td> 
									<td class="align-middle">{{$category->created_at}}</td>
									<td class="align-middle">{{$category->updated_at}}</td>
									<td class="align-middle">
										<a href="{{route('admin.categorias.edit', $category->id)}}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
										{{-- <button class="btn btn-danger btn-sm" title="Remover"><i class="fas fa-trash"></i> </button> --} }
									</td>
								</tr>	
							@empty
								<tr>
									<td colspan="6">
										<div class="alert alert-info text-center">Não há items para exibir</div>
									</td>
								</tr>
							@endforelse
											
						</tbody>
					</table>
					{{ $categories->links() }}
				</div>
				
				
			</div>
		</div> --}}
@endsection