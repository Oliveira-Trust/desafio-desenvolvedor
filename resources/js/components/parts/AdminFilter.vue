<template>
	<div class="row">
		<div class="col col-12">
			<h4>Filtro</h4>
		</div>
		<div class="form-group col col-12">
			<label for="term" class="form-label">Termo</label>
			<input type="date" v-if="filterInputTypeDate" v-model="filters.filteredTerm" name="term-filter" id="term" placeholder="Buscar" class="form-control form-control-sm">
			<input type="text" v-else v-model="filters.filteredTerm" name="term-filter" id="term" placeholder="Buscar" class="form-control form-control-sm">
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
			<button @click="clearFilters" type="button" class="btn btn-secondary btn-sm" title="Limpar filtros"><i class="fas fa-times pr-2"></i> Limpar filtros</button>
		</div>
	</div>
</template>

<script>
	export default {
		name	: 	'AdminFilter',
		props	:	['fields'],
		data() {
			return {
				filters: {
					filteredTerm: '',
					filteredField: ''
				},
			}
		},
		methods: {
			clearFilters () {
				this.filters = _.mapValues(this.filters, () => '');
				this.$emit('emitFilter', {filters: this.filters})
				
			},
		},
		watch: {
			'filters.filteredTerm' (val) {
				this.$emit('emitFilter', {filters: this.filters})
			},
			'filters.filteredField' (val) {
				this.$emit('emitFilter', {filters: this.filters})
			}
		},
		computed: {
			hasFilter () {
				return _.some(this.filters, (p) => Boolean(p));
			},
			filterInputTypeDate(){
				return this.filters.filteredField == 'birth' || this.filters.filteredField == 'paid_at'
			},
		}
	}
</script>