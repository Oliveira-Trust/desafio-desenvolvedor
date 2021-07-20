<template>
<div>
    <div class="row bg-white">

        <div class="col-12">
            <form :action="getAction" method="post" class="form-horizontal" @submit.prevent="onSubmit">
                <input type="hidden" name="_token" :value="csrfToken" id="_token"/>
                <input v-if="inEdit" type="hidden" name="_method" value="PUT" />

                <div class="row">
                    <div class="col-lx-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mt-3 mb-3 font-weight-bold" v-if="!inEdit">Adicionar Produto</h4>
                        <h4 class="mt-3 mb-3 font-weight-bold" v-else>Editar Produto</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="form-group">
                            <label for="name" class="label-validation">Nome <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="name" id="name" v-model.trim="$v.name.$model"  class="form-control" placeholder="Digite o nome do produto" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.name.required && $v.name.$dirty">O campo <strong>E-mail</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.name.minLength">O campo <strong>E-mail</strong> precisa ter pelo menos <strong>{{$v.name.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.name.maxLength">O campo <strong>E-mail</strong> precisa ter até <strong>{{$v.name.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.name" class="alert alert-danger">{{ getError(errors.name) }}</p>
                        </div>
                    </div>

                    <div class="col-xl-12 col-sm-12">
                        <div class="form-group">
                            <label for="label" class="label-validation">Parte da URL (slug) <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="label" id="label" v-model.trim="$v.label.$model"  v-on:blur="makeSlug(label)"  class="form-control" placeholder="Digite a parte da url para este produto" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.label.required && $v.label.$dirty">O campo <strong>Parte da URL</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.label.minLength">O campo <strong>Parte da URL</strong> precisa ter pelo menos <strong>{{$v.label.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.label.maxLength">O campo <strong>Parte da URL</strong> precisa ter até <strong>{{$v.label.$params.maxLength.max}}</strong> caracteres.</div>
								<div class="alert alert-danger" v-if="!$v.label.labelCheck && $v.label.$dirty">A URL só aceita letras, números e traços (-), não aceita espaços e caracteres especiais.</div>
                            </div>

                            <p v-if="errors.label" class="alert alert-danger">{{ getError(errors.label) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12">
                        <div class="form-group">
                            <label for="description" class="label-validation">Descrição <span class="req"></span></label>
                            <div class="input-validation">
                                <textarea  name="description" id="description" v-model.trim="$v.description.$model"  class="form-control" placeholder="Digite a descrição do produto" />
                                <div class="alert alert-danger" v-if="!$v.description.required && $v.description.$dirty">O campo <strong>Parte da URL</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.description.minLength">O campo <strong>Parte da URL</strong> precisa ter pelo menos <strong>{{$v.description.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.description.maxLength">O campo <strong>Parte da URL</strong> precisa ter até <strong>{{$v.description.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.description" class="alert alert-danger">{{ getError(errors.label) }}</p>
                        </div>
                    </div>
					
					<div class="col-xl-12 col-sm-12">
						<div class="row">
							<div class="col-xl-4 col-sm-12">
								<div class="form-group">
									<label for="value" class="label-validation">Valor <span class="req"></span></label>
									<div class="input-validation">
										<vue-numeric currency="R$" separator="." name="value" id="value" v-model="value" class="form-control" placeholder="Digite o valor do produto" v-bind:precision="2" :empty-value="`${value}`"></vue-numeric>
										<div class="alert alert-danger" v-if="!$v.value.required && $v.value.$dirty">O campo <strong>E-mail</strong> é obrigatório.</div>
										<div class="alert alert-danger" v-if="!$v.value.minLength">O campo <strong>E-mail</strong> precisa ter pelo menos <strong>{{$v.value.$params.minLength.min}}</strong> caracteres.</div>
										<div class="alert alert-danger" v-if="!$v.value.maxLength">O campo <strong>E-mail</strong> precisa ter até <strong>{{$v.value.$params.maxLength.max}}</strong> caracteres.</div>
									</div>

									<p v-if="errors.value" class="alert alert-danger">{{ getError(errors.value) }}</p>
								</div>
							</div>
							<div class="col-xl-4 col-sm-12">
								<div class="form-group">
									<label for="category_id" class="label-validation">Categoria <span class="req"></span></label>
									<div class="input-validation">
										<select v-model="category_id" class="form-control">
											<option value="">Selecione uma opção...</option>
											<option :value="category.code" v-for="(category, i) in categoriesOptions" :key="i">
												{{ category.label }}
											</option>
										</select>
									</div>

									<p v-if="errors.category_id" class="alert alert-danger">{{ getError(errors.category_id) }}</p>
								</div>
							</div>
							<div class="col-xl-4 col-sm-12">
								<div class="form-group">
									<label for="enabled" class="label-validation">Ativar produto? <span class="req"></span></label>
									<div class="input-validation">
										<select v-model="enabled" class="form-control">
											<option value="">Selecione uma opção...</option>
											<option :value="opcao.value" v-for="(opcao, i) in [{ value : 0, text : 'Não ativar', class : 'danger' }, { value: 1, text : 'Sim, ativar' }]" :key="i">
												{{ opcao.text }}
											</option>
										</select>
									</div>

									<p v-if="errors.enabled" class="alert alert-danger">{{ getError(errors.enabled) }}</p>
								</div>
							</div>
						</div>
					</div>
                </div>

                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <button type="submit" class="btn btn-success btn-block" :disabled="submitStatus === 'PENDING'" id="submit">Salvar</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

</template>

<script>
    import { required, between, minLength, maxLength } from 'vuelidate/lib/validators'
	import { labelCheck } from '../../../../../resources/js/customvalidations.js' // my validations
    export default {
        props: ['productData', 'errors', 'inEdit', 'categories'],
        data() {
            return {
                submitStatus                :   null,
                name						:	'',
                label						:	'',
                description					:	'',
                value						:	'',
                category_id					:	'',
                enabled                     :   0,
            }
        },
        created() {
            if (this.inEdit) {
                this.name						=	this.productData.name
                this.label						=	this.productData.label
                this.description				=	this.productData.description
                this.category_id				=	this.productData.category_id
                this.enabled					=	this.productData.enabled

				setTimeout(() => {
					this.value = (this.productData.value != "0.00") ? this.formatPrice(this.productData.value) : "R$ 0,001"
				}, 200);
            }
        },
        methods: {
			formatPrice(value){
				let val = (value/1).toFixed(2).replace('.', ',')		
        		return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			// faz parte de uma URL de acordo com o que é digitado no campo "Nome"
			makeSlug(text){
				this.label = this.getSlug(text)
			},

            getSlug(text) {
				text = text.toLowerCase().trim().replace(/ /g, '-')
				text = this.convertToNormalCharacters(text)
				text = text.replace(/[^a-z\-0-9]/g, '')
				return text
			},
			convertToNormalCharacters(text) {
				return text.replace(/[àáâãä]/g, 'a')
					.replace(/[èéêẽë]/g, 'e')
					.replace(/[ìíîĩï]/g, 'i')
					.replace(/[òóôõö]/g, 'o')
					.replace(/[ùúûũü]/g, 'u')
					.replace(/ç/g, 'c')
			},

			
            checkErros() {
                if(this.$v.$invalid){
                    var txt2 = '<p class="text-left"><strong>Ainda há campos que precisam de sua atenção!</strong><br><br>'

                    var all = document.querySelectorAll('.alert-danger')

                    for (var o = 0; o < all.length; o++) {
                        txt2 += '<span class="fas fa-chevron-right"> </span> ' + all[o].innerHTML;
                        if(o < all.length){
                            txt2 += "<br>"
                        }
                    }
                
                    txt2 += '</p>'

                    this.$swal.fire({
                        icon		:	'error',
                        title		:	'Oops...',
                        html		:	txt2
                    })
                }
            },

            onSubmit() {
                this.submitStatus = 'PENDING'
                this.$v.$touch()

                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                    // show errors
                    this.checkErros()
                } else {
                    axios({ 
						method		:	!this.inEdit  ? 'post'	: 'patch',
						url			:	this.getAction, 
						data	:	{
                            csrfToken					:	this.csrfToken,
                            
                            name					    :	this.name,
                            label					    :	this.label,
                            description				    :	this.description,
                            category_id				    :	this.category_id,
                            value				    	:	this.value,
                            enabled				        :	this.enabled,
                        }

                    }).then((response) => { 
                        if (response.status === 200 || response.status === 201) { 
                            this.submitStatus = 'OK'
                            this.$swal.fire({
                                icon		:	'success',
                                title		:	'Sucesso!',
                                html		:	response.data.message
                            })
                            setTimeout(() => {
                                window.location = '/admin/produtos'
                            }, 2500);
                        }
                        return false;
                    }) .catch((e) => { 
                        this.submitStatus = 'ERROR'
                        
                        var arr = Object.values(e.response.data.errors)
                        
                        var txt2 = '<p class="text-left"><strong>Ainda há campos que precisam de sua atenção!</strong><br><br>'

                        for (var o = 0; o < arr.length; o++) {
                            txt2 += '<span class="fas fa-chevron-right"> </span> ' + arr[o];
                            if(o < arr.length){
                                txt2 += "<br>"
                            }
                        }
                    
                        txt2 += '</p>'

                        this.$swal.fire({
                            icon		:	'error',
                            title		:	'Oops...',
                            html		:	txt2
                        })
                    }); 
                }
            },
            getError(errors) {
                return _.first(errors)
            }
        },
        
        watch:{
			name(newName) {
				if (newName) {
					this.label = this.getSlug(newName)
				} else {
					this.label = ''
				}
			},
		},
        computed: {
            categoriesOptions(){
                return _.map(this.categories , (category) =>{
                    return {
                        code : category.id,
                        label : category.name 
                    }
                })
            },
            csrfToken() {
                return window.axios.defaults.headers.common['X-CSRF-TOKEN']
            },
            
            getAction() {
                return this.inEdit ? `/admin/produtos/${this.productData.id}` : '/admin/produtos'
            }
        },

        validations() {
            return { 

                name: {
                    required		,
                    minLength		: minLength(3),
                    maxLength		: maxLength(255)
                },
                label: {
                    required		,
                    labelCheck		,
                    minLength		: minLength(5),
                    maxLength		: maxLength(255)
                },
				description: {
                    required		,
                    minLength		: minLength(20),
                    maxLength		: maxLength(5000)
                },
				category_id: {
                    required		,
                },
				value: {
                    required		,
                    minLength		: minLength(3),
                    maxLength		: maxLength(255)
                },
                enabled: {
                    required		,
                    between         :   between(0, 1)
                },
            }
        },
    }
</script>

<style>
    span.req::after { content : " [*]"; color: #F00; font-weight: bolder;}
</style>
