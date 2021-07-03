<template>
<div>
	<div class="row">
    
		<div class="col-xl-10 col-sm-12 py-4">
			<div class="row">
				<div class="form-group col-lg-2 col-sm-12">
					<label for="form-label" class="form-label">Filtro</label>
				</div>
				<div class="form-group col-lg-3 col-sm-12">
					<div class="col">
						<!-- <label for="term" class="form-label">Termo</label> -->
						<input type="text" v-model="filters.filteredTermClient" name="client-term-filter" id="term" placeholder="Buscar" class="form-control  form-control-sm">
					</div>
				</div>
				<div class="form-group col-lg-3 col-sm-12">
					<div class="col">
						<!-- <label for="term" class="form-label">Campo</label> -->
						<select class="form-control  form-control-sm" v-model="filters.filteredFieldClient" name="client-field-filter" id="field">
							<option value="">Selecione o campo</option>
							<option :value="field.key" v-for="(field, i) in fields.reduce((d, i, idx, l) => idx < l.length - 1 ? [...d, i] : d, [])" :key="i">
								{{ field.label }}
							</option>
						</select>
					</div>
				</div>
				<div class="form-group col-lg-3  col-sm-12" v-if="hasFilter">
					<button @click="clearFilters" class="btn btn-secondary btn-sm" title="Limpar filtros"><i class="fas fa-times pr-2"></i> Limpar filtros</button>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-sm-12 py-4">
			<a href="/admin/clientes/create" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus-circle"></i> Adicionar</a>
		</div>

    	<div class="col-12">

			
            <b-table striped hover :items="items" :fields="fields" :show-empty="true" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc">
	
                <template  v-slot:cell(name)="data">
                  	<div>{{ data.item.user.name }}</div>
                </template>
				
                <template  v-slot:cell(city_id)="data">
                  	<div>{{ data.item.city.name }}</div>
                </template>

                <template  v-slot:cell(birth)="data">
                  	<div v-format-date="'DD/MM/YYYY'">{{ data.item.birth }}</div>
                </template>

                <template  v-slot:cell(created_at)="data">
                  	<div v-format-date="'DD/MM/YYYY [às] HH:mm'">{{ data.item.user.created_at }}</div>
                </template>

                <template  v-slot:cell(updated_at)="data">
                  	<div v-format-date="'DD/MM/YYYY [às] HH:mm'">{{ data.item.updated_at }}</div>
                </template>

                <template  v-slot:cell(enable)="data">
                  	<div>{{ data.item.user.enable == true ? 'Sim' : 'Não' }}</div>
                </template>


                <template  v-slot:cell(actions)="data">
					<a :href="`/admin/clientes/${data.item.id}/edit`" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
					<button @click="remove(data.item)" class="btn btn-danger btn-sm" title="Remover"><i class="fas fa-trash"></i> </button>
                </template> 

                <template slot="empty">
                  <p class="alert alert-info text-center">Ainda não há registros.</p>
                </template>
            </b-table>

			<pagination :limit="2" :show-disabled="true" :data="paginationData" @pagination-change-page="changePage"></pagination>
			
        </div>
	</div>
</div>

</template>

<script>

import pagination from 'laravel-vue-pagination'
export default {
	props: ['clientes'],
    components: { pagination },

	data() {

		return {
            paginationData	:	{},
			items			:	[],
			page			:	1,
			filters: {
                filteredTermClient: '',
                filteredFieldClient: ''
            },
			sortBy			:	'id',
			sortDesc		:	false,
			fields: [
				{ key: 'id', sortable: true, label: 'ID' },
				{ key: 'name', sortable: true, label: 'Nome' },
				{ key: 'phone_number', sortable: true, label: 'Telefone' },
				{ key: 'phone_number2', sortable: true, label: 'Telefone 2' },
				{ key: 'birth', sortable: true, label: 'Nascimento' },
				{ key: 'city_id', sortable: true, label: 'Cidade' },
				{ key: 'enable', sortable: true, label: 'Ativado?' },
				{ key: 'created_at', sortable: true, label: 'Criado em' },
				{ key: 'updated_at', sortable: true, label: 'Atualizado em' },
				{ key: 'actions' }
			]
		}
	},
	
    watch: {
        page () {
            this.getResults()
        },
		'filters.filteredTermClient' (val) {
            this.page = 1;
            this.getResults();
        },
		'filters.filteredFieldClient' (val) {
            this.page = 1;
            this.getResults();
        }
	},
	created() {
		// Fetch initial results
		this.getResults();
	},
	methods: {
		// Our method to GET results from a Laravel endpoint
		async getResults() {
			const term = this.filters.filteredTermClient;
			const field = this.filters.filteredFieldClient;
			const page = this.page;

			const response = await axios.get('/admin/clientes/buscar', {params: {page, term, field}});
			//this.items = response.data.data;
			this.items = term == '' && field == '' ?  response.data.data : response.data;
			this.paginationData = response.data;
		},
		
        clearFilters () {
            this.filters = _.mapValues(this.filters, () => '');
            this.getResults();
        },
		
        changePage (page) {
            this.page = page;
        },
		

    	remove(cliente) {
			this.$swal.fire({
				title: 'Atenção!',
				text: `Deseja realmente remover o cliente: ${cliente.user.name}?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				confirmButtonText: 'Remover',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if(result.value) {
					axios.delete(`/admin/clientes/${cliente.id}`).then((response) => {
						if(response.status === 200) {
							this.$swal.fire('', 'Cliente removido com sucesso!', 'success')
						}
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
        }
    }
}
</script>
