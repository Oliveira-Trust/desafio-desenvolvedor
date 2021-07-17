<template>
<div>
    <div class="row">
        <div class="col-12">
            <form method="post" class="form-horizontal" @submit.prevent="onSubmit">
                <input type="hidden" name="_token" :value="csrfToken" id="_token"/>
                <input v-if="inEdit" type="hidden" name="_method" value="PUT" />

                <div class="row">
                    <div class="col-xl-8 col-sm-12 bg-white order-xl-first order-sm-last">
                        <h4 class="mt-3 mb-3 font-weight-bold" v-if="!inEdit">Criar Pedido</h4>
                        <h4 class="mt-3 mb-3 font-weight-bold" v-else>Editar Pedido #{{orderData.id}}</h4>
						
						<div class="row" v-if="clientSetted == 0 && step == 1">
							<div class="col-12">
								<h5 class="mt-3 mb-1 font-weight-bold">Passo 1</h5>

								<div class="form-group">
									<label for="client_id" class="label-validation">Escolha um cliente para este pedido <span class="req"></span></label>
									<div class="row">
										<div class="col-xl-10 col-sm-8">
											<div class="input-validation">
												<v-select :options="clientsOptions" name="client_id" v-model="client_id" :reduce="client => client.code" label="label">
													<template #search="{attributes, events}">
														<input class="vs__search" :required="!client_id" v-bind="attributes" v-on="events" />
													</template>
												</v-select>
												<div class="alert alert-danger" v-if="!$v.client_id.required && $v.client_id.$dirty">O campo <strong>Cliente</strong> é obrigatório.</div>
											</div>
										</div>
										<div class="col-xl-2 col-sm-4">
											<button type="button" @click="nextStep()" class="btn btn-success btn-sm" title="Próximo">Próximo <i class="fas fa-angle-right"></i> </button>
										</div>
									</div>
									<p v-if="errors.client_id" class="alert alert-danger">{{ getError(errors.client_id) }}</p>
								</div>
							</div>
						</div>

						<div class="row" v-if="client_id != '' && clientSetted == 1 && step == 2">
							<div class="col-xl-12 product-box">
								<h5 class="mt-3 mb-1 font-weight-bold">Passo 2</h5>
								<label for="client_id" class="label-validation">Escolha o(s) produto(s) <span class="req"></span></label>
							</div>
							<div class="col-12 py-4">
								<div class="row">
									<div class="col-xl-5 col-sm-12">
										<admin-filter :fields="fields" v-on:emitFilter="emitFilter" v-on:emitClearFilter="emitClearFilter"></admin-filter>
									</div>
									<div class="col-xl-7 col-sm-12">
										<div class="row">
											<div class="col col-12">
												
											</div>
											<div class="col col-12">
												<sort-items :fields="fields" v-on:emitSubmitSort="emitSubmitSort"></sort-items>
											</div>
										</div>
									</div>
									
								</div>
								<div class="table-responsive-md table-responsive-sm">
									<table class="table table-striped table-bordered table-hover table-sm">
										<thead class="thead-dark">
											<tr>
												<th scope="col" v-for="(field, i) in fields.filter((_, i) => i > 0)" :key="i">{{field.label}}</th>
											</tr>
										</thead>
										<tbody v-if="items.length > 0">
											<tr v-for="(item, i) in items" :key="i">
												<th scope="row" class="align-middle">{{item.pid}}</th>
												<td class="align-middle">{{item.pname}}</td>
												<td class="align-middle">{{formatPrice(item.value)}}</td>
												<td class="align-middle">{{item.cname}}</td>
												<td class="align-middle">
													<div class="row">
														<div class="col-6">
															<select :name="`quantity-${item.pid}`" :id="`quantity-${item.pid}`" class="form-control form-control-sm">
																<option :value="opcao" v-for="(opcao, i) in [ 1,2,3,4,5,6,7,8,9,10 ]" :key="i" :selected="opcao == 1">
																	{{ opcao }}
																</option>
															</select>
														</div>
														<div class="col-6">
															<button type="button" @click="addToCart(item)" class="btn btn-info btn-sm" title="Adicionar ao carrinho"><i class="fas fa-shopping-cart"></i> </button>
														</div>
													</div>
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

								<div class="row">
									<div class="col-6">
										<button type="button" @click="backStep()" class="btn btn-warning btn-sm" title="Voltar"><i class="fas fa-angle-left"></i> Voltar </button>
									</div>
									<div class="col-6">
										<button type="button" @click="nextStep()" :disabled="this.cart.length == 0" class="btn btn-success btn-sm float-right" title="Próximo">Próximo <i class="fas fa-angle-right"></i> </button>
									</div>
								</div>
							</div>
						</div>

						<div class="row" v-if="clientSetted == 1 && step == 3 && cart.length > 0">
							<div class="col-12">
								<h5 class="mt-3 mb-1 font-weight-bold">Passo 3</h5>
								<div class="row">
									<div :class="`col-sm-12 ${status == 'PAGO' ? 'col-xl-6' : 'col-xl-12'}`">
										<div class="form-group">
											<label for="status" class="label-validation">Status do Pedido <span class="req"></span></label>
											<div class="input-validation">
												<select v-model="status" class="form-control">
													<option value="">Selecione uma opção...</option>
													<option :value="opcao.value" v-for="(opcao, i) in [{ value : 'EM_ABERTO', text : 'Em Aberto' }, { value: 'PAGO', text : 'Pago' }, { value: 'CANCELADO', text : 'Cancelado' }]" :key="i">
														{{ opcao.text }}
													</option>
												</select>
											</div>

											<p v-if="errors.status" class="alert alert-danger">{{ getError(errors.status) }}</p>
										</div>
									</div>
									<div class="col-xl-6 col-sm-12" v-if="status == 'PAGO'">
										<div class="form-group">
											<label for="paid_at" class="label-validation">Pago em <span class="req"></span></label>
											<div class="input-validation">
												<input type="date" name="paid_at" id="paid_at" v-model.trim="$v.paid_at.$model"  class="form-control" placeholder="Digite a data do pagamento do pedido" maxlenght="255" />
												<div class="alert alert-danger" v-if="!$v.paid_at.required && $v.paid_at.$dirty">O campo <strong>Pago em</strong> é obrigatório.</div>
												<div class="alert alert-danger" v-if="!$v.paid_at.minLength">O campo <strong>Pago em</strong> precisa ter pelo menos <strong>{{$v.paid_at.$params.minLength.min}}</strong> caracteres.</div>
												<div class="alert alert-danger" v-if="!$v.paid_at.maxLength">O campo <strong>Pago em</strong> precisa ter até <strong>{{$v.paid_at.$params.maxLength.max}}</strong> caracteres.</div>
											</div>

											<p v-if="errors.paid_at" class="alert alert-danger">{{ getError(errors.paid_at) }}</p>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-6">
										<button @click="backStep()" type="button" class="btn btn-warning btn-sm" title="Voltar"><i class="fas fa-angle-left"></i> Voltar </button>
									</div>
									<div class="col-6">
										<button @click="onSubmit()" type="button" :disabled="this.cart.length == 0" class="btn btn-success btn-sm float-right" title="Próximo">Finalizar pedido <i class="fas fa-check"></i> </button>
									</div>
								</div>
							</div>
						</div>

                    </div>
                    <div class="col-xl-3 offset-xl-1 col-sm-12 bg-white order-xl-last order-sm-first">
                        <h4 class="mt-3 mb-3 font-weight-bold">Carrinho </h4>
						<h5 class="float-left">{{formatPrice(this.total)}}</h5>
						<button @click="clearCart()" type="button" v-if="this.cart.length > 0" class="btn btn-danger btn-sm float-right mb-3" title="Limpar Carrinho">Limpar <i class="fas fa-trash"></i> </button>
						<div class="clearfix"></div>

						<div class="card mb-2" v-for="(item, i) in cart" :key="i">
							<div class="card-body">
								<h5 class="card-title">{{item.productName}}</h5>
								<h6 class="card-subtitle mb-2 text-muted">{{item.categoryName}}</h6>
								<div class="card-text float-left">{{item.productQuantity}} x </div>
								<div class="card-text float-right"> {{formatPrice(item.productValue)}}</div>
								<div class="clearfix"></div>
							</div>
							<div class="card-footer">
								<h6 class="float-left">SubTotal: {{formatPrice(item.subTotalValue)}}</h6>
								<a href="javascript:;" class="btn btn-sm btn-danger float-right" @click="removeItemCart(item.key)"><i class="fas fa-trash"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</template>

<script>
	import pagination from 'laravel-vue-pagination'
   	import { required, requiredIf, minLength, maxLength } from 'vuelidate/lib/validators'
   /*  
	import { labelCheck } from '../../../../../resources/js/customvalidations.js' // my validations */


    export default {
        props: ['orderData', 'errors', 'inEdit', 'clients'],
		components: { 
			pagination
		},
        data() {
            return {
                submitStatus                :   null,
				step						:	1,
                cart						:	[],	
				total						: 	'0.00',

				client_id					: 	'', 
				clientSetted				:	0,
				paid_at						: 	'',
				status						: 	'',

				paginationData				:	{},
				items						:	[],
				page						:	1,
				sortBy						: 	'id',
				sortDirection				: 	'ASC',
				filters: {
					filteredTerm			:	'',
					filteredField			:	''
				},
				
				fields: [
					{ key: '#', label: '#' },
					{ key: 'id', label: 'ID' },
					{ key: 'name', label: 'Nome' },
					{ key: 'value', label: 'Valor' },
					{ key: 'category', label: 'Categoria' },
					{ key: 'actions', label: 'Quantidade / Adicionar' },
				],
            }
        },

		created(){
			if(this.inEdit){
				this.client_id 			=	this.orderData.client_id
				this.status 			=	this.orderData.status
				this.paid_at 			=	this.orderData.paid_at != '1900-01-01' && this.orderData.paid_at != '1900-01-01T00:00:00.000000Z' ? this.orderData.paid_at : ''

				this.reloadCart()
				this.sumTotal()
			}
		},
		watch: {
			page () {
				this.getResults()
			},
		},
        methods: {
			nextStep(){
				if(this.step == 1){
					this.clientSetted = 1
					this.getResults();
				}
				
				this.step++;
			},
			backStep(){
				if(this.step == 2){
					this.clientSetted = 0
				}
				this.step--
			},
			emitSubmitSort(data){
				this.sortBy 		= data.sortBy
				this.sortDirection 	= data.sortDirection
				this.getResults();
			},
			emitFilter(data){
				this.page 			=	1
				this.filters		=	data.filters
				this.getResults();
			},
			emitClearFilter(data){
				this.filters = data.filters
				this.getResults();
			},

			// Our method to GET results from a Laravel endpoint
			async getResults() {
				const term = this.filters.filteredTerm;
				const field = this.filters.filteredField;
				const page = this.page;
				const sortBy = this.sortBy;
				const sortDirection = this.sortDirection;
				const CreateOrderPage = 1;

				const response = await axios.get('/admin/produtos/buscar', {params: {page, term, field, sortBy, sortDirection, CreateOrderPage}});
				this.items = typeof response.data.data != 'undefined' ?  response.data.data : response.data;
				this.paginationData = response.data;
			},
			
			changePage (page) {
				this.page = page;
			},
			
			formatPrice(price){
				return parseFloat(price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
			},

			addToCart(product){
				let qtt = document.getElementById(`quantity-${product.pid}`).value
				if(!qtt || qtt == 0){
					return false;
				}
				
				this.cart.push({ 
									key: this.cart.length, 
									productId : product.pid, 
									productName : product.pname, 
									categoryName : product.cname, 
									productQuantity : Number(qtt), 
									productValue : product.value, 
									subTotalValue :  product.value * Number(qtt), 
								});
				this.sumTotal();
			},
			sumTotal(){
				this.total = this.cart.reduce((n, {subTotalValue}) => n + subTotalValue, 0);
			},
			removeItemCart(key){
				this.cart = this.cart.filter((x) => x.key != key);
				this.sumTotal();
			},
			clearCart(){
				this.cart = [];
				this.total = '0.00';
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
                            csrfToken				:	this.csrfToken,
                            
                            client_id				:	this.client_id,
                            cart					:	this.cart,
                            paid_at					:	this.paid_at,
                            status					:	this.status,
                        }

                    }).then((response) => { 
                        if (response.status === 200 || response.status === 201) { 
                            this.submitStatus = 'OK'
                            this.$swal.fire({
                                icon		:	'success',
                                title		:	'Sucesso!',
                                html		:	response.data.message
                            })
                            /* setTimeout(() => {
                                window.location = '/admin/pedidos'
                            }, 2500); */
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
            },
			
			// used when edit order
			reloadCart(){
				let items = this.orderData.orderproduct;
				this.cart = items.map((item, key) => {
					return { 
							key				:	key, 
							productId		:	item.product_id,
							productName		:	item.product.name, 
							categoryName	:	item.product.category.name, 
							productQuantity	:	Number(item.quantity),
							productValue	:	item.product.value, 
							subTotalValue	:	item.product.value * Number(item.quantity), 
						}
				})
				this.sumTotal()
			},
        },
        computed: {
            csrfToken() {
                return window.axios.defaults.headers.common['X-CSRF-TOKEN']
            },
			clientsOptions(){
                return _.map(this.clients , (client) =>{
                    return {
                        code : client.id,
                        label : client.user.name + ' | ' + client.document + ' | ' + client.phone_number
                    }
                })
            },
            
            getAction() {
                return this.inEdit ? `/admin/pedidos/${this.orderData.id}` : '/admin/pedidos'
            }
        },

        validations() {
            return {
                client_id: {
                    required		,
                },
                status: {
                    required		,
                },
                paid_at: {
                    required: requiredIf(function(value){
						return this.status == 'PAGO'
					}),
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
