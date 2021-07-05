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
					<div class="row">
						<div class="col col-12">
							<h4>Filtro</h4>
						</div>
						<div class="form-group col col-12">
							<label for="term" class="form-label">Termo</label>
							<input type="text" v-model="filters.filteredTerm" name="term-filter" id="term" placeholder="Buscar" class="form-control form-control-sm">
						</div>
						<div class="form-group col col-12">
							<label for="field" class="form-label">Campo</label>
							<select class="form-control  form-control-sm" v-model="filters.filteredField" name="field-filter" id="field">
								<option value="">Selecione o campo</option>
								<option :value="field.key" v-for="(field, i) in fields.filter((element, index) => index < fields.length - 1).filter((_, i) => i > 0)" :key="i">
									{{ field.label }}
								</option>
							</select>
						</div>
						<div class="form-group col col-12" v-if="hasFilter">
							<button @click="clearFilters" class="btn btn-secondary btn-sm" title="Limpar filtros"><i class="fas fa-times pr-2"></i> Limpar filtros</button>
						</div>
					</div>
				</div>
				<div class="col-xl-7 col-sm-12">
					<div class="row">
						<div class="col col-12">
							<div class="row">
								<div class="col col-12">
									<h4>Deletar itens em massa</h4>
									<small>Selecione itens na caixa de seleção para assim, deleta-los.</small>
								</div>
								<div class="col col-12">
									<button @click="deleteItems" :class="`btn btn-sm ${checkedDelete.length == 0 ? 'btn-secondary' : 'btn-danger'}`" title="Deletar itens selecionados" :disabled="checkedDelete.length == 0">Deletar itens selecionados ({{checkedDelete.length}}) <i class="fas fa-trash pl-2"></i></button>
								</div>
							</div>
						</div>
						<div class="col col-12">
							<div class="row">
								<div class="col-12">
									<h4 class="pt-3">Ordem da listagem</h4>
								</div>
								<div class="col-xl-5 col-sm-12">
									<div class="form-group">
										<label for="sort-field" class="form-label">Campo</label>
										<select class="form-control form-control-sm" v-model="sortBy" name="sort-field" id="sort-field">
											<option value="">Selecione o campo</option>
											<option :value="field.key" v-for="(field, i) in fields.filter((element, index) => index < fields.length - 1).filter((_, i) => i > 0)" :key="i">
												{{ field.label }}
											</option>
										</select>
									</div>
								</div>
								<div class="col-xl-4 col-sm-12">
									<div class="form-group">
										<label for="sort-order" class="form-label">Ordem</label>
										<select class="form-control form-control-sm" v-model="sortDirection" name="sort-order" id="sort-order">
											<option :value="field.key" v-for="(field, i) in [ { key: '', label: 'Selecione'}, { key: 'ASC', label: 'Crescente'}, {key: 'DESC', label: 'Decrescente'} ]" :key="i">
												{{ field.label }}
											</option>
										</select>
									</div>
								</div>
								<div class="col-xl-3 col-sm-12 pt-4">
									<button @click="getResults" class="btn btn-sm btn-info mt-2" title="Ordenar"> Ordenar <i class="fas fa-sort pl-2"></i></button>
								</div>
							</div>
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
		'filters.filteredTerm' (val) {
            this.page = 1;
            this.getResults();
        },
		'filters.filteredField' (val) {
            this.page = 1;
            this.getResults();
        }
	},
	created() {
		// Fetch initial results
		this.getResults();
	},
	methods: {
		formatDate(date, format){
			return dayjs(date).format(format)
		},
		formatPrice(price){
			return "R$ " + (price/1).toFixed(2).replace('.', ',')
		},
		setClass(id){
			return !this.checkedDelete.find(x => x == id)
		},
		setColumnClass(){
			
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
		
        clearFilters () {
            this.filters = _.mapValues(this.filters, () => '');
            this.getResults();
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
		// delete selected items
		deleteItems(){
			let that = this
			let warnMessage = this.checkedDelete.length > 1 ? 'Deseja realmente remover os produtos selecionados?' : 'Deseja realmente remover o produto selecionado?'
			this.$swal.fire({
				title: 'Atenção!',
				text: warnMessage,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				confirmButtonText: 'Remover',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if(result.value) {
					axios.post(`/admin/produtos/delete-in-mass`, {
						items: that.checkedDelete
					}).then((response) => {
						this.$swal.fire('', response.data.message, 'success')
						_.mapValues(that.checkedDelete, (selected) => this.items = this.items.filter((it) => it.pid !== selected));
						this.checkedDelete = []
						this.getResults();
					}).catch((e) => {
						let error = _.get(e, 'response.data.message', 'Erro ao realizar a operação')
						console.log(error)
						this.$swal.fire('', error, 'error')
					})
				}
			})
		}
	},
	
    computed: {
        hasFilter () {
            return _.some(this.filters, (p) => Boolean(p));
        },
    }
}
</script>