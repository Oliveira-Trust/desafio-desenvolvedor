<template>
<div>
    <div class="row bg-white">

        <div class="col-12">
            <form :action="getAction" method="post" class="form-horizontal" @submit.prevent="onSubmit">
                <input type="hidden" name="_token" :value="csrfToken" id="_token"/>
                <input v-if="inEdit" type="hidden" name="_method" value="PUT" />

                <div class="row">
                    <div class="col-lx-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <h4 class="mt-3 mb-3 font-weight-bold" v-if="!inEdit">Adicionar Categoria</h4>
                        <h4 class="mt-3 mb-3 font-weight-bold" v-else>Editar Cliente</h4>
                        <hr>
                        <h4 class="mt-1 mb-3"><strong>Usuário</strong></h4>
                    </div>
                </div>
                <div class="row">                   
                    <div class="col-xl-12 col-sm-12">
                        <div class="form-group">
                            <label for="name" class="label-validation">Nome <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="name" id="name" v-model.trim="$v.name.$model" class="form-control" placeholder="Digite o nome da categoria" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.name.required && $v.name.$dirty">O campo <strong>Nome</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.name.minLength">O campo <strong>Nome</strong> precisa ter pelo menos <strong>{{$v.name.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.name.maxLength">O campo <strong>Nome</strong> precisa ter até <strong>{{$v.name.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.name" class="alert alert-danger">{{ getError(errors.name) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12">
                        <div class="form-group">
                            <label for="label" class="label-validation">Parte da URL (slug) <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="label" id="label" v-model.trim="$v.label.$model"  v-on:blur="makeSlug(label)"  class="form-control" placeholder="Digite a parte da url para esta categoria" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.label.required && $v.label.$dirty">O campo <strong>Parte da URL</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.label.minLength">O campo <strong>Parte da URL</strong> precisa ter pelo menos <strong>{{$v.label.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.label.maxLength">O campo <strong>Parte da URL</strong> precisa ter até <strong>{{$v.label.$params.maxLength.max}}</strong> caracteres.</div>
								<div class="alert alert-danger" v-if="!$v.label.labelCheck && $v.label.$dirty">A URL só aceita letras, números e traços (-), não aceita espaços e caracteres especiais.</div>
                            </div>

                            <p v-if="errors.label" class="alert alert-danger">{{ getError(errors.label) }}</p>
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
    import { required, minLength, maxLength } from 'vuelidate/lib/validators'
	import { labelCheck } from '../../../../../resources/js/customvalidations.js' // my validations


    export default {
        props: ['categoryData', 'errors', 'inEdit'],

        data() {
            return {
                submitStatus                :   null,
                name						:	'',
                label						:	'',
            }
        },
        created() {
            if (this.inEdit) {
                this.name						=	this.categoryData.name
                this.label						=	this.categoryData.label
            }
        },
        methods: {
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
                                window.location = '/admin/categorias'
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
            csrfToken() {
                return window.axios.defaults.headers.common['X-CSRF-TOKEN']
            },
            
            getAction() {
                return this.inEdit ? `/admin/categorias/${this.categoryData.id}` : '/admin/categorias'
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
                    minLength		: minLength(3),
                    maxLength		: maxLength(255)
                },
            }
        },
    }
</script>

<style>
    span.req::after { content : " [*]"; color: #F00; font-weight: bolder;}
</style>
