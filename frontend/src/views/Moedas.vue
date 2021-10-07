<template>
  <div class="moedas">
    <PageTitle
      icon="fa fa-coin"
      main="Conversor de Moedas"
      sub="Lista e Cadastro de Moedas e Taxas"
    />
    <b-form />

    <b-table
      id="moedas"
      hover
      striped
      :items="moedas"
      :fields="fieldsMoedas"
    >
      <template v-slot:cell(taxas.taxaBoleto)="data">
        {{ data.item.taxas.taxaBoleto }} %
      </template>
      <template v-slot:cell(taxas.taxaCartao)="data">
        {{ data.item.taxas.taxaCartao }} %
      </template>
      <template v-slot:cell(taxas.taxaConversaoMax)="data">
        {{ data.item.taxas.taxaConversaoMax }} %
      </template>
      <template v-slot:cell(taxas.taxaConversaoMin)="data">
        {{ data.item.taxas.taxaConversaoMin }} %
      </template>
      <template v-slot:cell(actions)="data">
        <b-button
          variant="warning"
          class="mr-2"
          @click="loadMoeda(data.item,'Editar')"
        >
          <i class="fa fa-pencil" />
        </b-button>
        <b-button
          variant="danger"
          @click="loadMoeda(data.item, 'Remover')"
        >
          <i class="fa fa-trash" />
        </b-button>
      </template>
    </b-table>
    <p class="mt-3">
      Pagina Atual: {{ currentPage }}
    </p>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="moedas"
    />
    <hr>
    <b-button
      v-if="save===null"
      variant="success"
      @click="loadMoeda(null,'Adicionar')"
    >
      Nova Moeda
    </b-button>

    <b-form v-else>
      <b-row>
        <b-col>
          <b-form-group
            label="Nome da Moeda:"
            label-form="moeda-nome"
          >
            <b-form-input v-model="moeda.nome" />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="Sigla da Moeda:"
            label-form="moeda-sigla"
          >
            <b-form-input v-model="moeda.sigla" />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-form-group
            label="Taxa Boleto:"
            label-form="moeda-taxaboleto"
          >
            <b-form-input
              v-model="moeda.taxas.taxaBoleto"
              lazy-formatter
              :formatter="formatter"
            />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="Taxa Cartão:"
            label-form="moeda-taxacartao"
          >
            <b-form-input
              v-model="moeda.taxas.taxaCartao"
              lazy-formatter
              :formatter="formatter"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-form-group
            label="Valor Controle:"
            label-form="moeda-valor_controle"
          >
            <b-form-input
              v-model="moeda.taxas.valor_controle"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-form-group
            label="Taxa Conversão Minima:"
            label-form="moeda-taxaConversaoMin"
          >
            <b-form-input
              v-model="moeda.taxas.taxaConversaoMin"
              lazy-formatter
              :formatter="formatter"
            />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="Taxa Conversão Máxima:"
            label-form="moeda-taxaConversaoMax"
          >
            <b-form-input
              v-model="moeda.taxas.taxaConversaoMax"
              lazy-formatter
              :formatter="formatter"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col>
          <b-button
            variant="primary"
            @click="salvar"
          >
            Salvar Moeda
          </b-button>
        </b-col>
        <b-col>
          <b-button
            @click="reset"
          >
            Limpar
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
export default {
    name: 'Moedas',
    components: { PageTitle },
    data () {
    return {
      save: null,
      moeda: {
        nome: null,
        sigla: null,
        taxas: { }
      },
      moedas: [],
      rows: 0,
      perPage: 5,
      currentPage: 1,
      fieldsMoedas: [
        { key: 'id', label: 'ID', sortable: true },
        { key: 'nome', label: 'Nome', sortable: true },
        { key: 'sigla', label: 'Sigla', sortable: true },
        { key: 'taxas.taxaBoleto', label: 'Taxa Boleto', sortable: true },
        { key: 'taxas.taxaCartao', label: 'Taxa Cartão', sortable: true },
        { key: 'taxas.valor_controle', label: 'Valor Controle Taxa', sortable: true },
        { key: 'taxas.taxaConversaoMax', label: 'Taxa Conversão (< Controle) ', sortable: true },
        { key: 'taxas.taxaConversaoMin', label: 'Taxa Conversão (>= Controle) ', sortable: true },
        { key: 'actions', label: 'Ações' }
      ]
    }
    },
    watch:{
      currentPage: {
      handler: function (value) {
        this.fetch().catch(error => {
           showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      }
    }
    },
    mounted () {
      this.loadMoedas()
    },
    methods: {
      loadMoedas () {
        const url = `${baseApiUrl}/moedas/listar`
        axios.get(url).then( res => {
          this.moedas = res.data.moedas
          this.rows = res.data.rows
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      async fecth () {
        const url = `${baseApiUrl}/moedas/listar`
        axios.get(url).then( res => {
          this.moedas = res.data.moedas
          this.rows = res.data.rows
            showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      reset () {
        this.moeda = {
        nome: null,
        sigla: null,
        taxas: { }
      }
      this.save = null
      this.loadMoedas()
      },
      salvar () {
        const path = this.save==='Adicionar' ? "nova":this.save==='Editar'? "editar":"deletar"
        const method = this.save==='Adicionar' ? "post":this.save==='Editar'? "put":"delete"
        const id = this.moeda.id ? `${path}/${this.moeda.id}`: path
        const url = `${baseApiUrl}/moedas/${id}`

        axios[method](url, this.moeda).then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
          this.loadMoedas()
           showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      loadMoeda (moeda, save = 'Adicionar') {
          if(save!=='Adicionar'){
            this.moeda = { ...moeda }
          }
          this.save = save
      },
      formatter(value) {
        const formato = new Intl.NumberFormat('en-US',{
        style: 'decimal',
        minimumFractionDigits: 2
        });
        return formato.format(value)
      }
    }
}
</script>

<style>

</style>
