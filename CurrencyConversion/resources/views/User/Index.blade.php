@extends('layouts.app')
@section('content')



<header>
	<ol>
		<li class="active">Usuário</li>
		@role('Currency Conversion create')
		<li class="active"><a href="{{ route("User.create") }}" ><i class="fa fa-plus text-success" aria-hidden="true"></i> Adicionar</a></li>
		@endrole

		
	</ol>

</header>



<div class="GrupoAcaoIndex">
</div>

<div class="info"></div>

<table cellpadding="0" cellspacing="0" border="0" class="Datatable table table-striped" width="100%">
	<thead>
		<tr>
			<th >Nome</th>
			<th >E-mail</th>
			<th >Usuário</th>
			<th >Ação</th>
		</tr>
	</thead>
	<tbody>
		<td colspan="2" class="dataTables_empty">Carregando os dados do servidor</td>


	</tbody>
	<tfoot>
		<tr>
			<th >Nome</th>
			<th >E-mail</th>
			<th >Usuário</th>
			<th >Ação</th>
		</tr>
	</tfoot>
</table>



<script type="text/javascript">
	$(document).ready(function() {


		$('.Datatable').DataTable( {
			processing: true,
			ajax: "{{ route('User.Datatable') }}", 

			columns: [
			{data: 'name'},

			{data: 'email'},
			{data: 'username'},

			{
				data: 'id',
				render: function ( data, type, row, meta ) {
					return '<a href="{{ route("User.index") }}/'+data+'" class="btn btn-success text-light" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Visualizar</a>'; 
				}
			},

			]

		} );







	});
</script>


@endsection