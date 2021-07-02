<template>
<div>
	<div class="row">
    
		<div class="col-12 py-4">
			<a href="/admin/clientes/create" class="btn btn-outline-success btn-sm float-right"><i class="fas fa-plus-circle"></i> Adicionar</a>
		</div>

    	<div class="col-12">
            <b-table striped hover :items="clientes" :fields="fields" :show-empty="true">
	
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
        </div>
	</div>
</div>

</template>

<script>
export default {
	props: ['clientes'],

	data() {

		return {
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

	methods: {
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
}
</script>
