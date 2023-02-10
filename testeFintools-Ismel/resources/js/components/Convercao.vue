<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="modal-body">
          <form class="form-signin mt-5 mb-5">
            <div class="text-center mb-4">
              <h1 class="h3 mb-3 font-weight-normal">DADOS PARA CONVERSÃO</h1>
            </div>

            <div class="form-label-group mt-2">
              <div class="form-label-group mt-2">
                <label for>Moeda de origem</label>

                <select class="form-control" v-model="moeda_origem" @change="cambio">
                  <option
                    v-for="moedas in list_moedas_origem"
                    :key="moedas.id"
                    :value="moedas.id"
                  >{{moedas.opcion}}</option>
                </select>
              </div>
            </div>

            <div class="form-label-group mt-2">
              <div class="form-label-group mt-2">
                <label for>Moeda de destino</label>

                <select class="form-control" v-model="moeda_destino">
                  <option
                    v-for="moedas2 in list_moedas_destino"
                    :key="moedas2.id"
                    :value="moedas2.id"
                  >{{moedas2.opcion}}</option>
                </select>
              </div>
            </div>

            <div class="form-label-group mt-2">
              <label for="validade_edit">Valor para conversão</label>
              <input
                type="number"
                id="valor_conversao"
                name="valor_conversao"
                class="form-control"
                v-model="valor_conversao"
                placeholder="Digite o valor de conversão"
                required
              />
            </div>

            <div class="form-label-group mt-2">
              <div class="form-label-group mt-2">
                <label for>Forma de Pagamento</label>

                <select class="form-control" v-model="forma_pagamento">
                  <option
                    v-for="pagamento in list_forma_pagamento"
                    :key="pagamento.id"
                    :value="pagamento.id"
                  >{{pagamento.opcion}}</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button
                class="btn btn-primary"
                id="btn_fazer_conversao"
                @click.prevent.self="conversao()"
                type="submit"
              >Fazer Cotação</button>
            </div>
          </form>
        </div>
      </div>

      

      <div class="col-sm-6">
        <div class="modal-body">
          <form class="form-signin mt-5 mb-5">
            <div class="text-center mb-4">
              <h1 class="h3 mb-3 font-weight-normal">CONVERSÃO FINALIZADA</h1>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Moeda de origem</label>
                  <input
                    type="text"
                    id="moeda_origem_finalizada"
                    name="moeda_origem_finalizada"
                    class="form-control"
                    v-model="moeda_origem_finalizada"
                    disabled
                  />
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Moeda de destino</label>
                  <input
                    type="text"
                    id="moeda_destino_finalizada"
                    name="moeda_destino_finalizada"
                    class="form-control"
                    v-model="moeda_destino_finalizada"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Valor para conversão</label>
                  <input
                    type="text"
                    id="valor_conversao_finalizada"
                    name="valor_conversao_finalizada"
                    class="form-control"
                    v-model="valor_conversao_finalizada"
                    disabled
                  />
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Forma de Pagamento</label>
                  <input
                    type="text"
                    id="forma_pagamento_finalizada"
                    name="forma_pagamento_finalizada"
                    class="form-control"
                    v-model="forma_pagamento_finalizada"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Valor usado para conversão</label>
                  <input
                    type="text"
                    id="valor_usado_conversao"
                    name="valor_usado_conversao"
                    class="form-control"
                    v-model="valor_usado_conversao"
                    disabled
                  />
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Valor Comprado</label>
                  <input
                    type="text"
                    id="valor_comprado"
                    name="valor_comprado"
                    class="form-control"
                    v-model="valor_comprado"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Taxa de Pagamento</label>
                  <input
                    type="text"
                    id="taxa_pagamento"
                    name="taxa_pagamento"
                    class="form-control"
                    v-model="taxa_pagamento"
                    disabled
                  />
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Taxa de conversão</label>
                  <input
                    type="text"
                    id="taxa_conversao"
                    name="taxa_conversao"
                    class="form-control"
                    v-model="taxa_conversao"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-label-group mt-2">
                  <label for>Valor para conversão com taxas</label>
                  <input
                    type="text"
                    id="valor_conversao_com_taxas"
                    name="valor_conversao_com_taxas"
                    class="form-control"
                    v-model="valor_conversao_com_taxas"
                    disabled
                  />
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-primary" id="btn_guardar_conversao" @click.prevent.self="guardarConversao()" type="submit">Guardar dados Cotação</button>

              <button class="btn btn-success" id="btn_enviar_conversao" @click.prevent.self="enviarConversao()" type="submit">Enviar dados Cotação</button>


            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row mt-5"></div>

      <hr />

      <h2 class="card-text text-center">LISTAGEM DE CONVERSÃO</h2>

      <div class="row" style="padding-top: 50px;">
        
        <div class="col-lg-12">
          <div class="card mb-4 p-4">
            <table class="table table-bordered table-striped table-hover" id="tabela-conversao">
              <thead>
                <tr>
                  <th scope="col">Moeda Origem</th>
                  <th scope="col">Moeda Destino</th>
                  <th scope="col">Valor Conv</th>
                  <th scope="col">Forma de Pag</th>
                  <th scope="col">Valor comprado</th>
                  <th scope="col">Taxa pag</th>
                  <th scope="col">Taxa conv</th>  
                  <th scope="col">Data</th>                
                </tr>
              </thead>
              <tbody>
                <tr v-for="conversao in conversoes" :key="conversao.id">
                  <th style="/*width: 12%;*/">{{conversao.moeda_origem}}</th>
                  <td style="/*width: 12%;*/">{{conversao.moeda_destino}}</td>
                  <td>{{conversao.valor_conversao}}</td>
                  <td>{{conversao.forma_pagamento}}</td>
                  <td>{{conversao.valor_comprado}}</td>
                  <td>{{conversao.taxa_pagamento}}</td>
                  <td>{{conversao.taxa_conversao}}</td>
                  <td>{{conversao.data_transacao}}</td>                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>    

      
    </div>


  </div>
</template>


<script>
export default {
  props:{

     user: {
      type: Object     
    }
  },
  data() {
    return {
      list_moedas: [
        { id: "1", opcion: "BRL" },
        { id: "2", opcion: "USD" },
        { id: "3", opcion: "EUR" }
      ],
      list_forma_pagamento: [
        { id: "1", opcion: "Boleto" },
        { id: "2", opcion: "Cartão Crédito" }
      ],
      conversoes: [],
      forma_pagamento: "1",
      list_moedas_destino: [],
      list_moedas_origem: [{ id: "1", opcion: "BRL" }],
      moeda_origem: "1",
      moeda_destino: "2",
      valor_conversao: "",
      moeda_origem_finalizada: "",
      moeda_destino_finalizada: "",
      valor_conversao_finalizada: "",
      forma_pagamento_finalizada: "",
      valor_usado_conversao: "",
      valor_comprado: "",
      taxa_pagamento: "",
      taxa_conversao: "",
      valor_conversao_com_taxas: "",
      taxa_conve: ""
    };
  },
  mounted() {
    this.cambio();
    this.disabledbotton();    
    this.getAllConversoes();
    this.gettable();    
  },
  methods: {
    cambio() {
      var element = this.moeda_origem;
      this.list_moedas_destino = [];
      var list = [];
      this.list_moedas.forEach(function(number) {
        if (number.id != element) {
          list.push(number);
        }
      });

      this.list_moedas_destino = list;
    },
    conversao() {
      if (this.moeda_origem == "") {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O campo Moeda origem é obrigatorio!"
        });
      } else if (this.moeda_destino == "") {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O campo Moeda destino é obrigatorio!"
        });
      } else if (this.valor_conversao == "") {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O campo Valor para conversão é obrigatorio!"
        });
      } else if (this.forma_pagamento == "") {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O campo Forma de Pagamento é obrigatorio!"
        });
      } else if (this.valor_conversao < 1000) {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O valor para conversão deve ser maior do que 1000,00!"
        });
      } else if (this.valor_conversao > 100000) {
        Swal.fire({
          type: "warning",
          title: "Atenção",
          html: "O valor para conversão deve ser menor do que 100.000,00!"
        });
      } else {
        var conversao = "";
        if (this.moeda_origem == 1 && this.moeda_destino == 2) {
          conversao = "USD-BRL";
        } else if (this.moeda_origem == 1 && this.moeda_destino == 3) {
          conversao = "EUR-BRL";
        }
        axios
          .get("/consumirapi", { params: { codigo: conversao } })
          .then(response => {

            var codConversao = _.replace(conversao, "-", "").toUpperCase();
            var valorcompra = response.data[codConversao].bid;
            this.calculoConversao(valorcompra);

            this.enabledbotton();
            
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    enviarConversao(){

      var m_destino = this.list_moedas[this.moeda_destino - 1];
      var f_pagamento = this.list_forma_pagamento[this.forma_pagamento - 1];

       axios.get("/send_email", { params: 
       { user: this.user,
         moeda_origem: "BRL",
         moeda_destino: m_destino.opcion,  
         valor_conversao: this.valor_conversao,    
         forma_pagamento: f_pagamento.opcion,      
         valor_usado_conversao: this.valor_usado_conversao ,
         valor_comprado: this.valor_comprado,
         taxa_pagamento: this.taxa_pagamento,
         taxa_conversao: this.taxa_conversao,
         valor_conversao_com_taxas: this.valor_conversao_com_taxas
        } })
        .then(response => {
           if( response.data =="success"){

            Swal.fire({
                  type: 'success',
                  title: 'Sucesso',
                  html: 'Correio enviado com sucesso!'
                        
            });

           }
           
        }).catch((error) => {
            
            Swal.fire({
                  type: 'error',
                  title: 'Erro',
                  html: 'Correio não enviado.!  '+error.message                  
            });
 
        });
      
    },    
    guardarConversao(){

        var form_pag = "";
        if (this.forma_pagamento == 1) {
        form_pag = this.list_forma_pagamento[0].opcion;
        } else {
            form_pag = this.list_forma_pagamento[1].opcion;
        }
        var data_t = this.dataAtualFormatada();
        

        axios.post("/save_cotacao",{
                moeda_origem: this.moeda_origem_finalizada,
                moeda_destino: this.moeda_destino_finalizada,
                valor_conversao: this.valor_conversao,
                forma_pagamento: form_pag,
                valor_usado_conversao: this.valor_usado_conversao,
                valor_comprado: this.valor_comprado,
                taxa_pagamento: this.taxa_pagamento,
                taxa_conversao: this.taxa_conversao,
                data_transacao: data_t,
                user_id: this.user.id                
            })
            .then(response => {
                
                if(response.data == "success"){
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Sucesso',
                        html: 'Cotação adicionado com sucesso!',
                        onClose: function(){

                            $('#moeda_origem_finalizada').val("");
                            $('#moeda_destino_finalizada').val("");
                            $('#valor_conversao').val("");
                            $('#forma_pagamento_finalizada').val("");
                            $('#valor_usado_conversao').val("");
                            $('#valor_comprado').val("");
                            $('#taxa_pagamento').val("");
                            $('#taxa_conversao').val("");
                            $('#valor_conversao_com_taxas').val("");
                            $('#valor_conversao').val("");
                            
                            
                            
                           $("#btn_guardar_conversao").prop('disabled', true);
                           $("#btn_enviar_conversao").prop('disabled', true);
                                                                
                        }
                    }); 

                    this.getAllConversoes();

                }else{

                    Swal.fire({
                        type: 'erro',
                        title: 'Atenção',
                        html: 'Todos os campos são obrigatorios!',
                       
                    }); 

                }

            }).catch((error) => {
                this.errors = error.response.data.errors;                
            });

    },
    disabledbotton(){
        $("#btn_guardar_conversao").prop('disabled', true);
        $("#btn_enviar_conversao").prop('disabled', true);
    },
    enabledbotton(){
        $("#btn_guardar_conversao").prop('disabled', false);
        $("#btn_enviar_conversao").prop('disabled', false);
    },
    dataAtualFormatada(){
        var data = new Date(),
            dia  = data.getDate().toString(),
            diaF = (dia.length == 1) ? '0'+dia : dia,
            mes  = (data.getMonth()+1).toString(),
            mesF = (mes.length == 1) ? '0'+mes : mes,
            anoF = data.getFullYear();
        return anoF+"-"+mesF+"-"+diaF;
    },
    gettable(){        

        axios.get("/getallcotacoes", { params: { id: 1 } })
        .then(response => {

            $("#tabela-conversao").DataTable({ 
                dom: "<'row'<'col-xl-6'l><'col-xl-6'Tf>r>" +
                    "t" +
                    "<'row'<'col-xl-6'i><'col-xl-6'p>>",
                tableTools: {
                    sSwfPath: "assets/js/datatables/tabletools/copy_csv_xls_pdf.swf"
                }
            });

        });

    },
    getAllConversoes(){ 
        axios.get("/getallcotacoes", { params: { id: this.user.id } })
        .then(response => {
           
           this.conversoes = response.data;           

        });
    },
    gettaxaConversao(){ 
        axios.get("/taxa_conversao", { params: { valor: this.valor_conversao } })
        .then(response => {
           
           this.taxa_conve = response.data.data[0].por_cento;   
           
    
        }).catch((error) => {
                this.errors = error.response.data.errors;                
        });
    },
    calculoConversao(valorcompra){ 
        
        axios.get("/calculo_conversao", { params: { valor_conversao: this.valor_conversao, forma_pagamento: this.forma_pagamento, valor_usado_conversao: valorcompra } })
        .then(response => {
           
            console.log(response.data);
           
            
            this.moeda_origem_finalizada = "BRL";
            if (this.moeda_destino == 2) {
              this.moeda_destino_finalizada = this.list_moedas[1].opcion;
            } else if (this.moeda_destino == 3) {
              this.moeda_destino_finalizada = this.list_moedas[2].opcion;
            }            
            this.valor_conversao_finalizada = this.valor_conversao;
            if (this.forma_pagamento == 1) {
              this.forma_pagamento_finalizada = this.list_forma_pagamento[0].opcion;
            } else {
              this.forma_pagamento_finalizada = this.list_forma_pagamento[1].opcion;
            }

            this.valor_usado_conversao = valorcompra;
            this.valor_comprado = response.data.data.valor_comprado_final;
            this.taxa_pagamento = response.data.data.taxa_pag;
            this.taxa_conversao = response.data.data.taxa_conv;
            this.valor_conversao_com_taxas = response.data.data.valor_usado_para_conversao;
           
    
        }).catch((error) => {
            console.log(error.response.data.errors) ;                
        });
    }
  },
  watch: {}
};
</script>  

<style scoped>
    #tabela-conversao {
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