<template>
<div>
	<div class="row">
		<div class="col-xl-10 col-sm-6 py-4">
			<h3>Categorias</h3>
		</div>
		<div class="col-xl-2 col-sm-6 py-4">
			<a href="/admin/categorias/create" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Adicionar</a>
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
					<tbody v-if="items.length > 0">
						<tr v-for="(item, i) in items" :key="i">
							<th scope="row" class="align-middle">{{item.id}}</th>
							<td class="align-middle">{{item.name}}</td>
							<td class="align-middle">{{item.product.length}}</td>
							<td class="align-middle">{{formatDate(item.created_at, 'DD/MM/YYYY [às] HH:mm')}}</td>
							<td class="align-middle">{{formatDate(item.updated_at, 'DD/MM/YYYY [às] HH:mm')}}</td>
							<td class="align-middle">
								<a :href="`/admin/produtos/?info=${item.id}`" class="btn btn-info btn-sm" title="Produtos desta categoria"><i class="fas fa-info"></i></a>
								<a :href="`/admin/categorias/${item.id}/edit`" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
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
		}
	},
	
    watch: {
        page() {
            this.getResults()
        },
	},
	created() {
		// Fetch initial results
		this.getResults();
	},
	methods: {
		formatDate(date, format){
			return dayjs(date).format(format)
		},

		// Our method to GET results from a Laravel endpoint
		async getResults() {
			const page = this.page;

			const response = await axios.get('/admin/categorias/buscar', {params: {page}});
			this.items = typeof response.data.data != 'undefined' ?  response.data.data : response.data;
			this.paginationData = response.data;
		},
		
        changePage (page) {
            this.page = page;
        },
    	remove(item) {
			this.$swal.fire({
				title: 'Atenção!',
				text: `Deseja realmente remover a categoria: ${item.cname}?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				confirmButtonText: 'Remover',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if(result.value) {
					axios.delete(`/admin/categorias/${item.id}`).then((response) => {
						this.$swal.fire('', response.data.message, 'success')
						this.items = this.items.filter((it) => it.id !== item.cid);
						this.getResults();
					}).catch((e) => {
						let error = _.get(e, 'response.data.message', 'Erro ao realizar a operação')
						console.log(error)
						this.$swal.fire('', error, 'error')
					})
				}
			})
		},
		
	},
}
</script>

<style>
.table.b-table > tbody > .table-active, .table.b-table > tbody > .table-active > th, .table.b-table > tbody > .table-active > td { background-color : rgba(240, 24, 24, 0.253) !important}
</style>