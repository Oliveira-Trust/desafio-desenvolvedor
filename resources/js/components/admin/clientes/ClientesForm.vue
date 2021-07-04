<template>
<div>
    <div class="row bg-white">

        <div class="col-12">
            <form :action="getAction" method="post" class="form-horizontal" @submit.prevent="onSubmit">
                <input type="hidden" name="_token" :value="csrfToken" id="_token"/>
                <input v-if="inEdit" type="hidden" name="_method" value="PUT" />

                <div class="row">
                    <div class="col-lx-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <h4 class="mt-3 mb-3 font-weight-bold" v-if="!inEdit">Adicionar Cliente</h4>
                        <h4 class="mt-3 mb-3 font-weight-bold" v-else>Editar Cliente</h4>
                        <hr>
                        <h4 class="mt-1 mb-3"><strong>Usuário</strong></h4>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-xl-4 col-sm-12">
                        <div class="form-group">
                            <label for="email" class="label-validation">E-mail <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="email" name="email" id="email" v-model.trim="$v.email.$model"  class="form-control" placeholder="Digite o e-mail do cliente" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.email.required && $v.email.$dirty">O campo <strong>E-mail</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.email.minLength">O campo <strong>E-mail</strong> precisa ter pelo menos <strong>{{$v.email.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.email.maxLength">O campo <strong>E-mail</strong> precisa ter até <strong>{{$v.email.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.email" class="alert alert-danger">{{ getError(errors.email) }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-12">
                        <div class="form-group">
                            <label for="password" class="label-validation">Senha <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="password" name="password" id="password" v-model.trim="$v.password.$model" class="form-control" placeholder="Digite a senha do cliente" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.password.required && $v.password.$dirty">O campo <strong>Senha</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.password.minLength">O campo <strong>Senha</strong> precisa ter pelo menos <strong>{{$v.password.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.password.maxLength">O campo <strong>Senha</strong> precisa ter até <strong>{{$v.password.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.password" class="alert alert-danger">{{ getError(errors.password) }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-12">
                        <div class="form-group">
                            <label for="enable" class="label-validation">Ativar usuário? <span class="req"></span></label>
                            <div class="input-validation">
                                <select v-model="enable" class="form-control">
                                    <option value="">Selecione uma opção...</option>
                                    <option :value="opcao.value" v-for="(opcao, i) in [{ value : 0, text : 'Não ativar', class : 'danger' }, { value: 1, text : 'Sim, ativar' }]" :key="i">
                                        {{ opcao.text }}
                                    </option>
                                </select>
                            </div>

                            <p v-if="errors.enable" class="alert alert-danger">{{ getError(errors.enable) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lx-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mt-1 mb-3"><strong>Cliente</strong></h4>
                    </div>
                </div>

                <div class="row">
                     <div class="col-12">
                        <div class="form-group">
                            <label for="name" class="label-validation">Nome <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="name" id="name" v-model.trim="$v.name.$model"  class="form-control" placeholder="Digite o nome do cliente" maxlenght="255" />
                                <div class="alert alert-danger" v-if="!$v.name.required && $v.name.$dirty">O campo <strong>Nome</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.name.minLength">O campo <strong>Nome</strong> precisa ter pelo menos <strong>{{$v.name.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.name.maxLength">O campo <strong>Nome</strong> precisa ter até <strong>{{$v.name.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.name" class="alert alert-danger">{{ getError(errors.name) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="phone_number" class="label-validation">Telefone <span class="req"></span></label>
                            <div class="input-validation">
                                <input v-mask="['(##) ####-####', '(##) #####-####']" type="tel" name="phone_number" id="phone_number" v-model.trim="$v.phone_number.$model"  class="form-control" placeholder="Digite o Telefone do cliente" maxlenght="15" />
                                <div class="alert alert-danger" v-if="!$v.phone_number.required && $v.phone_number.$dirty">O campo <strong>Telefone</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.phone_number.minLength">O campo <strong>Telefone</strong> precisa ter pelo menos <strong>{{$v.phone_number.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.phone_number.maxLength">O campo <strong>Telefone</strong> precisa ter até <strong>{{$v.phone_number.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.phone_number" class="alert alert-danger">{{ getError(errors.phone_number) }}</p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="phone_number2" class="label-validation">Telefone 2 </label>
                            <div class="input-validation">
                                <input v-mask="['(##) ####-####', '(##) #####-####']" type="tel" name="phone_number2" id="phone_number2" v-model.trim="$v.phone_number2.$model"  class="form-control" placeholder="Digite o Telefone do cliente" maxlenght="15" />
                                <div class="alert alert-danger" v-if="!$v.phone_number2.maxLength">O campo <strong>Telefone</strong> precisa ter até <strong>{{$v.phone_number2.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.phone_number2" class="alert alert-danger">{{ getError(errors.phone_number2) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="birth" class="label-validation">Data de nascimento <span class="req"></span></label>
                            <div class="input-validation">
                                <input v-mask="['##/##/####']" type="text" name="birth" id="birth" v-model.trim="$v.birth.$model"  class="form-control" placeholder="Digite a Data de Nascimento do cliente" maxlenght="10" />
                                <div class="alert alert-danger" v-if="!$v.birth.required && $v.birth.$dirty">O campo <strong>Data de Nascimento</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.birth.minLength">O campo <strong>Data de Nascimento</strong> precisa ter pelo menos <strong>{{$v.birth.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.birth.maxLength">O campo <strong>Data de Nascimento</strong> precisa ter até <strong>{{$v.birth.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.birth" class="alert alert-danger">{{ getError(errors.birth) }}</p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="document" class="label-validation">CPF <span class="req"></span> </label>
                            <div class="input-validation">
                                <input v-mask="['###.###.###-##']" type="text" name="document" id="document" v-model.trim="$v.document.$model"  class="form-control" placeholder="Digite o CPF do cliente" maxlenght="15"/>
                                <div class="alert alert-danger" v-if="!$v.document.required && $v.document.$dirty">O campo <strong>CPF</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.document.minLength">O campo <strong>CPF</strong> precisa ter pelo menos <strong>{{$v.document.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.document.maxLength">O campo <strong>CPF</strong> precisa ter até <strong>{{$v.document.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.document" class="alert alert-danger">{{ getError(errors.document) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lx-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="mt-1 mb-3"><strong>Endereço</strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address_zipcode" class="label-validation">CEP <span class="req"></span></label>
                            <div class="input-validation">
                                <input v-mask="['##.###-###']" type="text" name="address_zipcode" id="address_zipcode" @change="getAddress"  v-model.trim="$v.address_zipcode.$model"  class="form-control" placeholder="Digite o CEP para buscar o endereço do cliente" maxlenght="10" />
                                <div class="alert alert-danger" v-if="!$v.address_zipcode.required && $v.address_zipcode.$dirty">O campo  <strong>CEP do endereço do cliente</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.address_zipcode.minLength">O campo <strong>CEP do endereço do cliente</strong> precisa ter pelo menos <strong>{{$v.address_zipcode.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.address_zipcode.maxLength">O campo <strong>CEP do endereço do cliente</strong> precisa ter até <strong>{{$v.address_zipcode.$params.maxLength.max}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.address_zipcode.isUnique">O campo <strong>CEP do endereço do cliente</strong> possui um CEP inválido.</div>
                            </div>

                            <p v-if="errors.address_zipcode" class="alert alert-danger">{{ getError(errors.address_zipcode) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address_street" class="label-validation">Rua <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="text" name="address_street" readonly="readonly" id="address_street"  v-model.trim="$v.address_street.$model" class="form-control" placeholder="Digite o CEP para preencher a Rua/Estrada/Logradouro" maxlenght="255">
                                <div class="alert alert-danger" v-if="!$v.address_street.required && $v.address_street.$dirty">O campo  <strong>Rua</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.address_street.minLength">O campo <strong>Rua</strong> precisa ter pelo menos <strong>{{$v.address_street.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.address_street.maxLength">O campo <strong>Rua</strong> precisa ter até <strong>{{$v.street.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>
                            <p v-if="errors.street" class="alert alert-danger">{{ getError(errors.street) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address_number" class="label-validation">Número <span class="req"></span></label>
                            <div class="input-validation">
                                <input type="number" min="0" max="999999" name="address_number" id="address_number"  v-model.trim="$v.address_number.$model" class="form-control" placeholder="Digite o número do endereço">
                                <div class="alert alert-danger" v-if="!$v.address_number.required && $v.address_number.$dirty">O campo  <strong>Número</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.address_number.integer">O campo <strong>Número</strong> precisa ser apenas números. Caso seja S/Nº, colocar 0 (zero).</div>
                            </div>

                            <p v-if="errors.address_number" class="alert alert-danger">{{ getError(errors.address_number) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="address_complement" class="label-validation">Complemento do endereço </label>
                            <div class="input-validation">
                                <input type="text" name="address_complement" id="address_complement"  v-model.trim="$v.address_complement.$model" class="form-control" placeholder="Digite o Complemento do endereço" maxlenght="255">
                                <div class="alert alert-danger" v-if="!$v.address_complement.maxLength">O campo <strong>Complemento de endereço</strong> precisa ter até <strong>{{$v.address_complement.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>

                            <p v-if="errors.address_complement" class="alert alert-danger">{{ getError(errors.address_complement) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="address_neighborhood" class="label-validation">Bairro <span class="req"></span> </label>
                            <div class="input-validation">
                                <input type="text" name="address_neighborhood" readonly="readonly" id="address_neighborhood"  v-model.trim="$v.address_neighborhood.$model" class="form-control" placeholder="Digite o CEP para preencher este campo" maxlenght="255">
                                <div class="alert alert-danger" v-if="!$v.address_neighborhood.required && $v.address_neighborhood.$dirty">O campo  <strong>Bairro</strong> é obrigatório.</div>
                                <div class="alert alert-danger" v-if="!$v.address_neighborhood.minLength">O campo <strong>Bairro</strong> precisa ter pelo menos <strong>{{$v.address_neighborhood.$params.minLength.min}}</strong> caracteres.</div>
                                <div class="alert alert-danger" v-if="!$v.address_neighborhood.maxLength">O campo <strong>Bairro</strong> precisa ter até <strong>{{$v.address_neighborhood.$params.maxLength.max}}</strong> caracteres.</div>
                            </div>
                            <p v-if="errors.address_neighborhood" class="alert alert-danger">{{ getError(errors.address_neighborhood) }}</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="city_id" class="label-validation">Cidade <span class="req"></span></label>
                            <div class="input-validation">
                                <v-select :options="citiesOptions" name="city_id" v-model="city_id" :reduce="city => city.code" label="label">
                                    <template #search="{attributes, events}">
                                        <input class="vs__search" :required="!city_id" v-bind="attributes" v-on="events" />
                                    </template>
                                </v-select>
                                <div class="alert alert-danger" v-if="!$v.city_id.required && $v.city_id.$dirty">O campo <strong>Cidade</strong> é obrigatório.</div>
                            </div>
                            <p v-if="errors.city_id" class="alert alert-danger">{{ getError(errors.city_id) }}</p>
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
    import { required, requiredIf, email, between, minLength, maxLength, integer } from 'vuelidate/lib/validators'
    export default {
        props: ['clientData', 'errors', 'inEdit', 'cities'],

        data() {
            return {
                submitStatus                :   null,
                name						:	'',
                email						:	'',
                password					:	'',
                enable                      :   0,
                address_zipcode				:	'',
                address_street				:	'',
                address_number				:	'',
                address_complement			:	'',
                address_reference_address	:	'',
                address_neighborhood		:	'',
                city_id 					:	'',
                phone_number				:	'',
                phone_number2				:	'',
                birth	        			:	'',
                document        			:	'',
            }
        },
        created() {
            if (this.inEdit) {
                var dayjs = require('dayjs')
                this.name						=	this.clientData.user.name
                this.email						=	this.clientData.user.email
                this.enable						=	this.clientData.user.enable
                this.address_zipcode			=	this.clientData.address_zipcode
                this.address_street			    =	this.clientData.address_street
                this.address_number			    =	this.clientData.address_number
                this.address_complement			=	this.clientData.address_complement
                this.address_reference_address	=	this.clientData.address_reference_address
                this.address_neighborhood		=	this.clientData.address_neighborhood
                this.city_id		        	=	this.clientData.city.id
                
                this.phone_number			    =	this.clientData.phone_number
                this.phone_number2			    =	this.clientData.phone_number2
                this.birth			            =	dayjs(this.clientData.birth).format('DD/MM/YYYY')
                this.document			        =	this.clientData.document
            }
        },
        methods: {
            getAddress: function() {
                let that = this
                this.address_zipcode = this.address_zipcode.trim().replace(/[^0-9]/g, '')
                if (this.address_zipcode.length === 8) {
                    $.getJSON('https://viacep.com.br/ws/' + this.address_zipcode + '/json/', function(result){
                        if(typeof result.error != undefined && result.logradouro != ""){
                            that.address_street 		= result.logradouro;
                            that.address_neighborhood 	= result.bairro;
                        }
                    })
                }
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
                            email					    :	this.email,
                            password				    :	this.password,
                            enable				        :	this.enable,

                            phone_number				:	this.phone_number,
                            phone_number2				:	this.phone_number2,
                            birth				        :	this.birth,
                            document			        :	this.document,

                            address_zipcode				:	this.address_zipcode,
                            address_street				:	this.address_street,
                            address_number				:	this.address_number,
                            address_complement			:	this.address_complement,
                            address_reference_address	:	this.address_reference_address,
                            address_neighborhood		:	this.address_neighborhood,
                            city_id						:	typeof this.city_id.code == 'undefined' ? this.city_id : this.city_id.code,
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
                                window.location = '/admin/clientes'
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
        
        computed: {
            citiesOptions(){
                return _.map(this.cities , (city) =>{
                    return {
                        code : city.id,
                        label : city.name 
                    }
                })
            },
            csrfToken() {
                return window.axios.defaults.headers.common['X-CSRF-TOKEN']
            },
            
            getAction() {
                return this.inEdit ? `/admin/clientes/${this.clientData.id}` : '/admin/clientes'
            }
        },

        validations() {
            return { 

                name: {
                    required		,
                    minLength		: minLength(3),
                    maxLength		: maxLength(255)
                },
                email: {
                    required		,
                    email			,
                    minLength		: minLength(5),
                    maxLength		: maxLength(255)
                },
                password: {
                    required		:   requiredIf(function(value){
						return !this.inEdit
					}),
                    minLength		: minLength(8),
                    maxLength		: maxLength(255)
                },
                enable: {
                    required		,
                    between         :   between(0, 1)
                },

                address_zipcode: {
                    required		,
                    async isUnique (value) {
                        if (value === '') return true
                        value = value.trim().replace(/[^0-9]/g, '')
                        if(value.length === 8){
                            const response = await fetch(`https://viacep.com.br/ws/${value}/json/`)
                            let abc = await response.clone().json();
                            return Boolean(await abc.cep)
                        } else {
                            return false;
                        }
                    },
                    minLength		: minLength(8),
                    maxLength		: maxLength(10)
                },
                address_street: {
                    required		,
                    minLength		: minLength(1),
                    maxLength		: maxLength(255)
                },
                address_number: {
                    required		,
                    integer			,
                },
                address_complement: {
                    maxLength		: maxLength(255)
                },
                address_neighborhood: {
                    required		,
                    minLength		: minLength(1),
                    maxLength		: maxLength(255)
                },
                city_id: {
                    required		,
                },
                
                phone_number: {
                    required			,
                    minLength			: 	minLength(12),
                    maxLength			: 	maxLength(15),
                },
                phone_number2: {
                    minLength			: 	minLength(12),
                    maxLength			: 	maxLength(15),
                },
                document: {
                    required			,
                    minLength			: 	minLength(12),
                    maxLength			: 	maxLength(15),
                },
                birth: {
                    required			,
                    minLength			: 	minLength(10),
                    maxLength			: 	maxLength(10),
                },
            }
        },
    }
</script>

<style>
    span.req::after { content : " [*]"; color: #F00; font-weight: bolder;}
</style>
