<template>
	<div class="row">
		<div class="col col-12">
			<h4>Deletar itens em massa</h4>
			<small>Selecione itens na caixa de seleção para assim, deleta-los.</small>
		</div>
		<div class="col col-12">
			<button @click="deleteItems" :class="`btn btn-sm ${checkedDeleteItems.length == 0 ? 'btn-secondary' : 'btn-danger'}`" title="Deletar itens selecionados" :disabled="checkedDeleteItems.length == 0">Deletar itens selecionados ({{checkedDeleteItems.length}}) <i class="fas fa-trash pl-2"></i></button>
		</div>
	</div>
</template>

<script>
	export default {
		name	: 	'DeleteInMass',
		props	:	['checkedDeleteItems', 'route'],
		methods: {
			// delete selected items
			deleteItems(){
				let that = this
				let warnMessage = this.checkedDeleteItems.length > 1 ? 'Deseja realmente remover os items selecionados?' : 'Deseja realmente remover o item selecionado?'
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
						axios.post(`/admin/${that.route}/delete-in-mass`, {
							items: that.checkedDeleteItems
						}).then((response) => {
							this.$swal.fire('', response.data.message, 'success')
							that.$emit('filterLineInMass', {deleteItems: that.checkedDeleteItems })
							setTimeout(() => {
								this.checkedDeleteItems = []
								that.$emit('emitGetResults')
							}, 300);
						}).catch((e) => {
							let error = _.get(e, 'response.data.message', 'Erro ao realizar a operação')
							console.log(error)
							this.$swal.fire('', error, 'error')
						})
					}
				})
			}
		}
	}
</script>