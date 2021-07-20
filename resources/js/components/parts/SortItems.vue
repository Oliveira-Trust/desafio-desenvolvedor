<template>
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
			<button @click="emitGetResults" type="button" class="btn btn-sm btn-info mt-2" title="Ordenar"> Ordenar <i class="fas fa-sort pl-2"></i></button>
		</div>
	</div>
</template>

<script>
	export default {
		name	: 	'SortItems',
		props	:	['fields'],
		data() {
			return {
				sortBy			: 	'id',
				sortDirection	: 	'ASC',
			}
		},
		methods: {
			emitGetResults(){
				this.$emit('emitSubmitSort', {sortBy: this.sortBy, sortDirection: this.sortDirection })
			}
		}
	}
</script>