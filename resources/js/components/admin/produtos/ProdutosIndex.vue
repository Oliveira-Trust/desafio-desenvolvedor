<template>
<div>
	<div class="row">
		<div class="col-xl-10 col-sm-6 py-4">
			<h3>Produtos</h3>
		</div>
		<div class="col-xl-2 col-sm-6 py-4">
			<a href="/admin/produtos/create" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Adicionar</a>
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
							<delete-in-mass :checkedDeleteItems="checkedDelete" route="produtos" v-on:filterLineInMass="filterLineInMass" v-on:emitGetResults="emitGetResults"></delete-in-mass>
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
						<tr v-for="(item, i) in items" :key="i" :class="setClass(item.pid) == true ? '': 'table-warning'">
							<td class="align-middle">
								<div class="form-group form-check">
									<input type="checkbox" name="select-delete[]" class="form-check-input" :id="`select-delete-${item.pid}`" :value="item.pid"  v-model="checkedDelete">
								</div>
							</td>
							<th scope="row" class="align-middle">{{item.pid}}</th>
							<td class="align-middle">{{item.pname}}</td>
							<td class="align-middle">{{formatPrice(item.value)}}</td>
							<td class="align-middle">{{item.cname}}</td>
							<td class="align-middle">{{item.enabled == true ? 'Sim' : 'Não' }}</td>
							<td class="align-middle">{{formatDate(item.pcreated, 'DD/MM/YYYY [às] HH:mm')}}</td>
							<td class="align-middle">{{formatDate(item.pupdated, 'DD/MM/YYYY [às] HH:mm')}}</td>
							<td class="align-middle">
								<a :href="`/admin/produtos/${item.pid}/edit`" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
								<button @click="remove(item)" class="btn btn-danger btn-sm" title="Remover"><i class="fas fa-trash"></i> </button>
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
			
        </div>
	</div>
</div>

</template>

<script>

	import pagination from 'laravel-vue-pagination'
	import dayjs from 'dayjs'

	export default {
		components: { pagination, dayjs },

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
					{ key: 'name', label: 'Nome' },
					{ key: 'value', label: 'Valor' },
					{ key: 'category', label: 'Categoria' },
					{ key: 'enabled', label: 'Ativado?' },
					{ key: 'created_at', label: 'Criado em' },
					{ key: 'updated_at', label: 'Atualizado em' },
					{ key: 'actions', label: 'Ações' },
				],
				checkedDelete: []
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
				console.log(data) //deleteItems
				_.mapValues(data.deleteItems, (selected) => this.items = this.items.filter((it) => it.pid !== selected)); 
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
				return dayjs(date).format(format)
			},
			formatPrice(price){
				return parseFloat(price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
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
				const sortDirection = this.sortDirection;

				const response = await axios.get('/admin/produtos/buscar', {params: {page, term, field, sortBy, sortDirection}});
				this.items = typeof response.data.data != 'undefined' ?  response.data.data : response.data;
				this.paginationData = response.data;
			},
			
			changePage (page) {
				this.page = page;
			},
			remove(item) {
				this.$swal.fire({
					title: 'Atenção!',
					text: `Deseja realmente remover o produto: ${item.pname}?`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc3545',
					confirmButtonText: 'Remover',
					cancelButtonText: 'Cancelar'
				}).then((result) => {
					if(result.value) {
						axios.delete(`/admin/produtos/${item.pid}`).then((response) => {
							this.$swal.fire('', response.data.message, 'success')
							this.items = this.items.filter((it) => it.pid !== item.pid);
							this.getResults();
						}).catch((e) => {
							let error = _.get(e, 'response.data.message', 'Erro ao realizar a operação')
							console.log(error)
							this.$swal.fire('', error, 'error')
						})
					}
				})
			},
		}
	}
</script>