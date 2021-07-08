<template>
<div>
	<div class="row">
		<div class="col-xl-8 col-sm-6 py-4">
			<h3>Detalhes do Pedido #{{pedido.id}}</h3>
		</div>
		<div class="col-xl-4 col-sm-6 py-4">
			<button @click="orderDetails(items)" type="button" class="btn btn-info btn-sm float-right text-white" title="Detalhes"  data-toggle="modal" data-target="#productDetails"><i class="fas fa-search"></i> Detalhes do Pedido </button>
		</div>
	</div>
	<div class="row">
		<div class="col-12 py-4">
			<div class="row">
				<div class="col-xl-5 col-sm-12">
					<admin-filter :fields="fields" v-on:emitFilter="emitFilter" v-on:emitClearFilter="emitClearFilter"></admin-filter>
				</div>
				<div class="col-xl-7 col-sm-12">
					<div class="row">
						<div class="col col-12">
							<delete-in-mass :checkedDeleteItems="checkedDelete" route="pedidos" v-on:filterLineInMass="filterLineInMass" v-on:emitGetResults="emitGetResults"></delete-in-mass>
						</div>
						<div class="col col-12">
							<sort-items :fields="fields" v-on:emitSubmitSort="emitSubmitSort"></sort-items>
						</div>
					</div>
				</div>
			</div>
		</div>
    	<div class="col-12">
			<div class="table-responsive-md table-responsive-sm">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="thead-dark">
						<tr>
							<th scope="col" v-for="(field, i) in fields" :key="i">{{field.label}}</th>
						</tr>
					</thead>
					<tbody v-if="items.length > 0">
						<tr v-for="(item, i) in items" :key="i" :class="setClass(item.or_prod_id) == true ? '': 'table-warning'">
							<td class="align-middle">
								<div class="form-group form-check">
									<input type="checkbox" name="select-delete[]" class="form-check-input" :id="`select-delete-${item.or_prod_id}`" :value="item.or_prod_id"  v-model="checkedDelete">
								</div>
							</td>
							<th scope="row" class="align-middle">{{item.or_prod_id}}</th>
							<td class="align-middle">{{item.prod_name}}</td>
							<td class="align-middle">{{item.cat_name}}</td>
							<td class="align-middle">{{item.or_prod_quantity }}</td>
							<td class="align-middle">{{formatPrice(item.or_prod_value)}}</td>
							<td class="align-middle">{{formatPrice(item.or_prod_value * item.or_prod_quantity)}}</td>
							<td class="align-middle">
								<button @click="productDetails(item)" type="button" class="btn btn-info text-white btn-sm" title="Detalhes"  data-toggle="modal" data-target="#productDetails"><i class="fas fa-search"></i> </button>
							</td>
						</tr>					
					</tbody>
					<tbody v-else>
						<tr>
							<td colspan="11">
								<div class="alert alert-info text-center">Não há items para exibir</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<pagination :limit="10" :show-disabled="true" :data="paginationData" @pagination-change-page="changePage"></pagination>

			<div class="modal fade" id="productDetails" tabindex="-1" role="dialog" aria-labelledby="modalDetails" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalDetails">{{modalDetailsTitle}}</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" id="modalBody">
							<table class="table table-striped table-bordered table-hover table-sm">
								<tbody v-if="modalData.length > 0">
									<tr v-for="(item, i) in modalData" :key="i">
										<td v-if="item.type == 'header'" colspan="2" class="text-center"><strong>{{item.text}}</strong></td>
										<td v-if="item.type == 'text'"><strong>{{item.text}}</strong></td>
										<td v-if="item.type == 'text'">{{item.value}}</td>
									</tr>					
								</tbody>
								<tbody v-else>
									<tr>
										<td colspan="11">
											<div class="alert alert-info text-center">Não há items para exibir</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<a :href="modalEditButton" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
			
        </div>
	</div>
</div>

</template>

<script>

	import pagination from 'laravel-vue-pagination'
	import dayjs from 'dayjs'

	export default {
		components: { pagination, dayjs },
		props : ['pedido'],
		data() {
			return {
				paginationData	:	{},
				items			:	[],
				page			:	1,
				sortBy			: 	'id',
				sortDirection	: 	'ASC',
				filters: {
					filteredTerm: '',
					filteredField: ''
				},
				fields: [
					{ key: '#', label: '#' },
					{ key: 'id', label: 'ID' },
					{ key: 'name', label: 'Produto' },
					{ key: 'category', label: 'Categoria' },
					{ key: 'quantity', label: 'Quantidade' },
					{ key: 'value', label: 'Valor Unitário' },
					{ key: 'subtotal', label: 'SubTotal' },
					{ key: 'actions', label: 'Ações' },
				],
				checkedDelete: [],

				modalDetailsTitle	: 	'',
				modalEditButton		: 	'',
				modalData			: 	[],
			}
		},
		
		watch: {
			page () {
				this.getResults()
			},
		},
		created() {
			// Fetch initial results
			this.getResults();
		},
		methods: {
			emitSubmitSort(data){
				this.sortBy 		= data.sortBy
				this.sortDirection 	= data.sortDirection
				this.getResults();
			},
			filterLineInMass(data){
				_.mapValues(data.deleteItems, (selected) => this.items = this.items.filter((it) => it.or_prod_id !== selected)); 
			},
			emitFilter(data){
				this.page 			=	1
				this.filters		=	data.filters
				this.getResults();
			},
			emitGetResults(data){
				this.getResults();
			},
			emitClearFilter(data){
				this.filters = data.filters
				this.getResults();
			},

			formatDate(date, format){
				if(!date || date == '' || date == null || date == 'undefined'){
					return '-'
				}
				return dayjs(date).format(format)
			},
			formatPrice(price){
				return parseFloat(price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
			},
			formatStatus(status){
				if(status == 'PAGO'){
					return 'Pago'
				} else if(status == 'CANCELADO'){
					return 'Cancelado'
				} else if(status == 'EM_ABERTO'){
					return 'Em Aberto'
				}
			},


			getStatus(status){
				if(status == 'EM_ABERTO'){
					return "Em Aberto";
				} else if(status == 'PAGO'){
					return "Pago";
				} else if(status == 'CANCELADO'){
					return "Cancelado";
				} else {
					return "-";
				}
			},
			setClass(id){
				return !this.checkedDelete.find(x => x == id)
			},
			// Our method to GET results from a Laravel endpoint
			async getResults() {
				const term = this.filters.filteredTerm;
				const field = this.filters.filteredField;
				const page = this.page;
				const sortBy = this.sortBy;
				const order_id = this.pedido.id;
				const sortDirection = this.sortDirection;

				const response = await axios.get(`/admin/${this.pedido.id}/buscar-itens-pedido`, {params: {page, term, field, sortBy, sortDirection, order_id}});
				this.items = typeof response.data.data != 'undefined' ?  response.data.data : response.data;
				this.paginationData = response.data;
			},
			
			changePage (page) {
				this.page = page;
			},

			productDetails(item){
				this.modalDetailsTitle 	= 'Detalhes do Produto';
				this.modalEditButton	=	`/admin/produtos/${item.prod_id}/edit`

				this.modalData = [
					{
						text		: 	'ID',
						value		: 	item.prod_id,
						type		: 	'text'
					},
					{
						text		: 	'Nome',
						value		: 	item.prod_name,
						type		: 	'text'
					},
					{
						text		: 	'Valor Atual',
						value		: 	this.formatPrice(item.prod_value),
						type		: 	'text'
					},
					{
						text		: 	'Descrição',
						value		: 	item.prod_desc,
						type		: 	'text'
					},
					{
						text		: 	'Ativo',
						value		: 	item.prod_enabled == 1 ? 'Sim' : 'Não',
						type		: 	'text'
					}
				]
			},
			orderDetails(items){
				this.modalDetailsTitle 		= 'Detalhes do Pedido';
				this.modalEditButton	=	`/admin/pedidos/${items[0].prod_id}/edit`

				this.modalData = [
					{ text		: 	'DETALHES DO PEDIDO',  		value		: 	'', 													type 		: 	'header' },
					{ text		: 	'Total',  					value		: 	this.formatPrice(items[0].total), 					type 		: 	'text' },
					{ text		: 	'Status',  					value		: 	items[0].status == 'EM_ABERTO' ? 'Em Aberto' : _.upperFirst(items[0].status), 					type 		: 	'text' },
					{ text		: 	'Pago em',  				value		: 	items[0].paid_at != '1900-01-01' ? 	this.formatDate(items[0].paid_at, 'DD/MM/YYYY') : '-', 		type 		: 	'text' },
					
					{ text		: 	'DADOS DO CLIENTE',  		value		: 	'', 												type 		: 	'header' },
					{ text		: 	'Nome',  					value		: 	items[0].uname, 									type 		: 	'text' },
					{ text		: 	'Documento',  				value		: 	items[0].cli_document, 								type 		: 	'text' },
					{ text		: 	'E-mail',  					value		: 	items[0].uemail, 									type 		: 	'text' },
					{ text		: 	'Telefone',  				value		: 	items[0].cli_phone_number, 							type 		: 	'text' },
					{ text		: 	'Telefone 2',  				value		: 	items[0].cli_phone_number2,							type 		: 	'text' },
					{ text		: 	'Data de Nascimento',  		value		: 	this.formatDate(items[0].cli_birth, 'DD/MM/YYYY'), 	type 		: 	'text' },
					{ text		: 	'ENDEREÇO DO CLIENTE',  	value		: 	'', 												type 		: 	'header' },
					{ text		: 	'CEP',  					value		: 	items[0].cli_address_zipcode, 						type 		: 	'text' },
					{ text		: 	'Rua',  					value		: 	items[0].cli_address_street, 						type 		: 	'text' },
					{ text		: 	'Numero',  					value		: 	items[0].cli_address_number, 						type 		: 	'text' },
					{ text		: 	'Complemento',  			value		: 	items[0].cli_address_complement, 					type 		: 	'text' },
					{ text		: 	'Bairro',  					value		: 	items[0].cli_address_neighborhood, 					type 		: 	'text' },
					{ text		: 	'Cidade',  					value		: 	items[0].ci_name, 									type 		: 	'text' },
					{ text		: 	'Estado',  					value		: 	items[0].st_abbr, 									type 		: 	'text' },
					
					
				]
			}
		}
	}
</script>