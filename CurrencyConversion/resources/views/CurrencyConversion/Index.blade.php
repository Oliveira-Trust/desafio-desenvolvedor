@extends('layouts.app')
@section('content')



<header>
	<ol>
		<li class="active">Conversão</li>
		@role('Currency Conversion create')
		<li class="active"><a href="{{ route("CurrencyConversion.create") }}" ><i class="fa fa-plus text-success" aria-hidden="true"></i> Adicionar</a></li>
		@endrole

		
	</ol>

</header>



<div class="GrupoAcaoIndex">
</div>

<div class="info"></div>

<table cellpadding="0" cellspacing="0" border="0" class="Datatable table table-striped" width="100%">
	<thead>
		<tr>
			<th >Data</th>
			<th >Destino</th>
			<th >Valor</th>
			<th >F. Pagamento</th>
			<th >Cotação</th>
			<th >V. Comprado</th>
			<th >Usuário</th>
			<th >Ação</th>
		</tr>
	</thead>
	<tbody>
		<td colspan="2" class="dataTables_empty">Carregando os dados do servidor</td>


	</tbody>
	<tfoot>
		<tr>
			<th >Data</th>
			<th >Destino</th>
			<th >Valor</th>
			<th >F. Pagamento</th>
			<th >Cotação</th>
			<th >V. Comprado</th>
			<th >Usuário</th>
			<th >Ação</th>
		</tr>
	</tfoot>
</table>




<script type="text/javascript">
	$(document).ready(function() {


		$('.Datatable').DataTable( {
			processing: true,
			ajax: "{{ route('CurrencyConversion.Datatable') }}", 

			columns: [
			{data: 'created_at'},
			{data: 'currency.abbreviation'},

			{data: 'origin_value'},
			{data: 'payment_method'},

			{data: 'tax_currency'},

			{data: 'converted_value'},
			{data: 'user.name'},
			{
				data: 'id',
				render: function ( data, type, row, meta ) {
					return '<a href="{{ route("CurrencyConversion.index") }}/'+data+'" class="btn btn-success text-light" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Visualizar</a>'; 
				}
			},

			],
			initComplete: function () {
				this.api().columns().every( function () {
					var column = this;
					var select = $('<select><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
				} );
			}

		} );







	});
</script>


@endsection