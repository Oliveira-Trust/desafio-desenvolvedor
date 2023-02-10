<template>


<div>
    
    <div class="jumbotron text-center">
        <h1 class="display-4 ">FINTOOLS</h1>
        
        <h1>Cadastro e controle de taxas</h1>
        <p class="lead">
            
        </p>
    </div> 
                        


<div class="container">

                

                <div class="row mt-5">
                   
                </div>

                <hr/>

                <h2 class="card-text text-center"></h2>

               <div class="row" style="padding-top: 50px;">
                    <button type="submit" class="btn btn-primary ml-3 mb-4" data-toggle="modal" data-target="#formInserir" title="Inserir"><i class="fa fa-solid fa-plus"></i> Inserir Taxa</button>
					<div class="col-lg-12">
						<div class="card mb-4 p-4">
                                                        
							<table class="table table-bordered table-striped table-hover" id="tabela-taxa">

                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Valor Máximo</th>
                                    <th scope="col">Valor Mínimo</th>
                                    <th scope="col">Por Cento %</th>
                                    <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="(taxa, index) in taxas" :key="taxa.id">
                                    <th scope="row">{{index + 1}}</th>
                                    <td>{{taxa.valor_max}}</td>
                                    <td>{{taxa.valor_min}}</td>
                                    <td>{{taxa.por_cento}}</td>
                                    <td style="width: 12%;">

                                        <button type="submit" class="btn btn-primary btn-edit" @click.prevent.self="edit(taxa.id)" data-toggle="modal" data-target="#formEdit" title="Editar"><i class='fa fa-pencil'></i></button>
                                        
                                        <button type="submit" class="btn btn-danger btn-delete" @click.prevent.self="remover(taxa.id)"  title="Remover"><i class="fa fa-times"></i> </button>                                                                                              
                                        
                                    </td>
                                    </tr>
                                    
                                </tbody>
        
                            </table>
						</div>
					</div>
				</div>


                <div class="modal fade" id="formInserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin mt-5 mb-5">
                                <div class="text-center mb-4">
                                    <h1 class="h3 mb-3 font-weight-normal">Dados Taxa</h1>        
                                </div>  

                                <div v-if="errors">
                                    <div v-for="(v, k) in errors" :key="k">
                                         
                                        <div class="alert alert-warning">
                                            <p v-for="error in v" :key="error" class="">
                                            {{error}} 
                                            </p>
                                        </div>                                        
                                    
                                    </div>
                                </div>                             

                                <div class="form-label-group mt-2">
                                    <label for="nome">Valor Máximo</label>
                                    <input type="number" id="valor_max" name="valor_max" class="form-control" v-model="valor_max" required="" autofocus="">
                                </div>

                                

                                <div class="form-label-group mt-2">
                                    <label for="lote">Valor Mínimo</label>
                                    <input type="number" id="valor_min" name="valor_min" class="form-control" v-model="valor_min" required="" autofocus="">
                                    
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="validade">Por cento %</label>
                                    <input type="text" id="por_cento" name="por_cento" class="form-control" v-model="por_cento" required="" autofocus="">
                                    
                                </div>                               
                                             
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"  @click.prevent.self="inserir()"  type="submit"><i class="fa fa-solid fa-plus"></i>  Inserir</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin mt-5 mb-5">
                                <div class="text-center mb-4">
                                    <h1 class="h3 mb-3 font-weight-normal">Editar Taxa</h1>        
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="nome">Valor Máximo</label>
                                    <input type="hidden" id="id" name="id" class="form-control" v-model="id">
                                    <input type="number" id="valor_max_edit" name="valor_max_edit" class="form-control" v-model="valor_max_edit" required="" autofocus="">
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="lote_edit">Valor Mínimo</label>
                                    <input type="number" id="valor_min_edit" name="valor_min_edit" class="form-control" v-model="valor_min_edit" required="" autofocus="">
                                    
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="validade_edit">Por cento %</label>
                                    <input type="text" id="por_cento_edit" name="por_cento_edit" class="form-control" v-model="por_cento_edit" required="" autofocus="">
                                    
                                </div>
                                
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"  @click.prevent.self="update(id)"  type="submit" >Editar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    
                        </div>
                        </div>
                    </div>
                </div>

</div>
</div>

 
    
</template>


<script>


export default {

    data(){
    return {        
        taxas: [],
        valor_max: "",
        valor_min: "",
        por_cento:"",
        id:"",
        valor_max_edit:"",
        valor_min_edit:"",
        por_cento_edit:"",
        errors:""   

    }
   },
   mounted(){
        this.getAllTaxas();
        this.gettable();        
   },
   methods: {
    
    async getAllTaxas(){

        axios.get("/all_taxas")
        .then(response => {
            
            if(response.data){
                      
                this.taxas= response.data;      
            }

        });
    },
    async inserir(){        

        
        if(this.valor_max == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo valor máximo é obrigatorio!',
           
        }); 

        }else if(this.valor_min == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo valor mìnimo é obrigatorio!',
            
        }); 

        }else if(this.por_cento == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo por cento é obrigatorio!',
            
        }); 

        }else{

            
            axios.post("/save_taxa",{
                valor_max: this.valor_max,
                valor_min: this.valor_min,
                por_cento: this.por_cento
            })
            .then(response => {
                
                if(response.data == "success"){
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Sucesso',
                        html: 'Taxa adicionada com sucesso!',
                        onClose: function(){

                            $('#valor_max').val("");
                            $('#valor_min').val("");
                            $('#por_cento').val("");                            
                                                                
                        }
                    }); 

                    this.getAllTaxas();

                }else{

                    Swal.fire({
                        type: 'erro',
                        title: 'Atenção',
                        html: 'Todos os campos são obrigatorios!',
                       
                    }); 

                }

            }).catch((error) => {
                console.log(error.response.data.errors) ;            
            });
            
        }          

    },    
    async edit(id){

       this.id = id;
       axios.get("get_taxa/"+id)
       .then(response => {
                        
            if(response.data){                
                this.valor_max_edit= response.data.valor_max;
                this.valor_min_edit= response.data.valor_min;
                this.por_cento_edit= response.data.por_cento;
                
            }
        });
    },
    async update(id){

        axios.put("update_taxa",{
        id:   this.id,    
        valor_max: this.valor_max_edit,
        valor_min: this.valor_min_edit,
        por_cento: this.por_cento_edit
    })
    .then(response => {
        
        if(response.data == "success"){

            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                html: 'Taxa atualizada com sucesso!',
                    onClose: function(){
                        
                        $('#valor_max_edit').val("");
                        $('#valor_min_edit').val("");
                        $('#por_cento_edit').val("");                         
                                                                
                    }
            });            
            
            this.getAllTaxas();

        }

    });
    },
    remover(id){

        
        Swal.fire({
            title: 'Você tem certeza que deseja excluir a taxa selecionada?',
            text: "Você não poderá reverter isso!",            
            type: "warning",
            animation: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: "Agora não!",
            showLoaderOnConfirm: false
            }).then((result) => {
            if (result.value) {

                
                axios.delete("delete_taxa/"+id)
                .then(response => {
                    
                    if(response.data == "success"){ 

                        Swal.fire({
                            type: 'success',
                            title: 'Sucesso',
                            html: 'Taxa removida com sucesso!'
                               
                        });       

                        this.getAllTaxas();

                    }

                });

            }
        })

        
    },    
    async gettable(){        

        axios.get("/all_taxas")
        .then(response => {

            $("#tabela-taxa").DataTable({ 
                dom: "<'row'<'col-xl-6'l><'col-xl-6'Tf>r>" +
                    "t" +
                    "<'row'<'col-xl-6'i><'col-xl-6'p>>",
                tableTools: {
                    sSwfPath: "assets/js/datatables/tabletools/copy_csv_xls_pdf.swf"
                }
            });

        });

    }

   }
    
}
</script>

<style scoped>
    #tabela-taxa {
			float: right;
		}

		.pagination {
			float: right;
		}

		table.table-bordered tbody td {
			padding: 10px;
			text-align: center;
		}

		table.dataTable thead>tr>th {
			padding: 10px;
			text-align: center;
		}
        .btn-edit{
            margin-right: 5px;
        }

        .btn-delete{
            width: 41%;
        }
</style>